<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkproducts extends MY_Controller
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
        $this->get_view('products', $data);
    }

    public function add_products()
    {

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage'] = $this->upload('products', 850);
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['pdimage'] = $this->upload('products', 600, 'A');
            endif;
            if (isset($_FILES['catalogFile']) && !$_FILES['catalogFile']['error']):
                $file = $this->upload('products', false, 'catalog');
                $post['catalog_path'] = $file['file_path'];
                $post['catalog_name'] = $file['file_name'];
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['carouselA_image'] = $this->upload('products', 850, 'B');
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['carouselB_image'] = $this->upload('products', 850, 'C');
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['carouselC_image'] = $this->upload('products', 850, 'D');
            endif;
            $post['features'] = json_encode($post['features']);
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_products', $post);
            redirect('bkproducts');
        }
        $data = array(
            'order' => $this->product->select_products_order(),
            'is_home' => $this->product->product_show(true),
            'is_product_page' => $this->product->product_show(false, true),
            'plist' => $this->product->get_product_list()
        );
        $this->get_view('add_products', $data);
    }

    public function edit_products($PID = false)
    {
        $product = $this->product->get_products_by_pid($PID);

        if (!$product) {
            redirect('bkproducts');
        }

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage'] = $this->upload('products', 850);
                if ($product && file_exists($product->bgimage)) {
                    unlink($product->bgimage);
                }
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['pdimage'] = $this->upload('products', 850, 'A');
                if ($product && file_exists($product->pdimage)) {
                    unlink($product->pdimage);
                }
            endif;
            if (isset($_FILES['catalogFile']) && !$_FILES['catalogFile']['error']):
                $file = $this->upload('products', false, 'catalog');
                $post['catalog_path'] = $file['file_path'];
                $post['catalog_name'] = $file['file_name'];
                if ($product && file_exists($product->catalog_path)) {
                    unlink($product->catalog_path);
                }
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['carouselA_image'] = $this->upload('products', 850, 'B');
                if ($product && file_exists($product->carouselA_image)) {
                    unlink($product->carouselA_image);
                }
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['carouselB_image'] = $this->upload('products', 850, 'C');
                if ($product && file_exists($product->carouselB_image)) {
                    unlink($product->carouselB_image);
                }
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['carouselC_image'] = $this->upload('products', 850, 'D');
                if ($product && file_exists($product->carouselC_image)) {
                    unlink($product->carouselC_image);
                }
            endif;
            $post['features'] = json_encode($post['features']);
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_products', $post, array('PID' => $PID));
            redirect('bkproducts');
        }
        $data = array(
            'product' => $product,
            'is_home' => $this->product->product_show(true),
            'is_product_page' => $this->product->product_show(false, true),
            'plist' => $this->product->get_product_list()
        );
        $this->get_view('edit_products', $data);
    }

    public function delete_products($PID = false)
    {
        $product = $this->product->get_products_by_pid($PID);
        if ($product) {
            if (file_exists($product->bgimage)) {
                unlink($product->bgimage);
            }
            if (file_exists($product->pdimage)) {
                unlink($product->pdimage);
            }
            if (file_exists($product->catalog_path)) {
                unlink($product->catalog_path);
            }
            if (file_exists($product->carouselA_image)) {
                unlink($product->carouselA_image);
            }
            if (file_exists($product->carouselB_image)) {
                unlink($product->carouselB_image);
            }
            if (file_exists($product->carouselC_image)) {
                unlink($product->carouselC_image);
            }
            $this->db->delete('tb_products', array('PID' => $PID));
        }
        redirect('bkproducts');
    }


    public function spec_column($PID=false)
    {

        $column=$this->product->get_spec_column($PID);

        $data=array(
            'column'=>$column,
            'PID'=>$PID
        );
        $this->get_view('spec_column',$data);
    }

    public function add_column($PID=false)
    {

        if ($post = $this->input->post(null, true)) {
            $post['PID'] = $PID;
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_spec_column', $post);
            redirect('bkproducts/spec_column/'.$PID);
        }
        $data = array(
            'order'=>$this->product->select_column_order($PID),
            'PID'=>$PID
        );
        $this->get_view('add_column', $data);
    }

    public function edit_column($PID = false,$SID=false)
    {

        $column = $this->product->get_spec_column_by_sid($PID,$SID);

        if (!$column) {
            redirect('bkproducts/spec_column/'.$PID);
        }

        if ($post = $this->input->post(null, true)) {
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_spec_column', $post, array('SID' => $SID));
            redirect('bkproducts/spec_column/'.$PID);
        }

        $data = array(
            'column' => $column
        );
        $this->get_view('edit_column', $data);
    }

    public function delete_column($PID = false,$SID=false)
    {
        $column = $this->product->get_spec_column_by_sid($PID,$SID);
        if ($column) {
            $this->db->delete('tb_spec_column', array('SID' => $SID));
        }
        redirect('bkproducts/spec_column/'.$PID);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}