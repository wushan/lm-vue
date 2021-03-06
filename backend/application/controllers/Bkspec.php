<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkspec extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_product_model', 'product');
    }

    public function index()
    {

        $product = $this->product->get_products();

        $data = array(
            'product' => $product
        );
        $this->get_view('spec', $data);
    }

    public function spec_form($PID = false)
    {

        $spec = $this->product->get_spec($PID);

        $data = array(
            'spec' => $spec,
            'PID' => $PID,
        );
        $this->get_view('spec_form', $data);
    }

    public function add_spec_form($PID = false)
    {
        $column = $this->product->get_spec_column($PID);
        $product = $this->product->get_products_by_pid($PID);
        if ($post = $this->input->post(null, true)) {
            $post['PID'] = $PID;
            $post['PDID'] = json_encode($post['PDID']);
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_spec', $post);
            redirect('bkspec/spec_form/' . $PID);
        }
        $data = array(
            'order' => $this->product->select_spec_order($PID),
            'PID' => $PID,
            'product' => $product,
            'pd' => $this->product->get_pd($PID),
            'column' => $column
        );
        $this->get_view('add_spec_form', $data);
    }

    public function edit_spec_form($PID = false, $SPID = false)
    {
        $column = $this->product->get_spec_column($PID);
        $product = $this->product->get_products_by_pid($PID);
        $spec = $this->product->get_spec_by_spid($PID, $SPID);
        if ($post = $this->input->post(null, true)) {
            $post['PID'] = $PID;
            $post['PDID'] = json_encode($post['PDID']);
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_spec', $post, array('SPID' => $SPID));
            redirect('bkspec/spec_form/' . $PID);
        }
        $data = array(
            'PID' => $PID,
            'product' => $product,
            'spec' => $spec,
            'pd' => $this->product->get_pd($PID),
            'column' => $column
        );
        $this->get_view('edit_spec_form', $data);
    }

    public function delete_spec_form($PID = false, $SPID = false)
    {
        $spec = $this->product->get_spec_by_spid($PID, $SPID);
        if ($spec) {
            $this->db->delete('tb_spec', array('SPID' => $SPID));
        }
        redirect('bkspec/spec_form/' . $PID);
    }

    public function get_spec_form_th()
    {
        $PDID = $this->input->post('PDID');
        if ($PDID) {
            foreach ($PDID as $row) {
                if ($row != 0) {
                    $pd = $this->product->get_pd_by_pdid($row);
                    echo '<td class="addth text-center">' . $pd->model . '</td>';
                }
            }
        }

    }

    public function get_spec_form_td()
    {
        $PDID = $this->input->post('PDID');
        $column = $this->input->post('column');
        if ($PDID) {
            foreach ($PDID as $row) {
                if ($row != 0) {
                    $pd = $this->product->get_pd_by_pdid($row);
                    if ($spec = $pd->spec) {
                        foreach (json_decode($spec) as $i => $srow) {
                            $data[] = $srow;
                        }
                    }else{
                        if($col=json_decode($column)){
                            foreach($col as $crow){
                                $data[] = '';
                            }
                        }
                    }

                }
            }
            echo json_encode($data);
        }

    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}