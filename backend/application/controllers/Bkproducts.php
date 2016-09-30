<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkproducts extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_product_model','product');
    }

    public function index()
    {

        $product=$this->product->get_products();

        $data=array(
            'product'=>$product
        );
        $this->get_view('products',$data);
    }

    public function add_products()
    {

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage']=$this->upload('products', 850);
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['pdimage']=$this->upload('products', 850,'A');
            endif;
            if (isset($_FILES['catalogFile']) && !$_FILES['catalogFile']['error']):
                $file=$this->upload('products',false,'catalog');
                $post['catalog_path']=$file['file_path'];
                $post['catalog_name']=$file['file_name'];
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['carouselA_image']=$this->upload('products', 850,'B');
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['carouselB_image']=$this->upload('products', 850,'C');
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['carouselC_image']=$this->upload('products', 850,'D');
            endif;
            $post['features']=json_encode($post['features']);
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_products', $post);
            redirect('bkproducts');
        }
        $data = array(
            'order'=>$this->product->select_products_order()
        );
        $this->get_view('add_products', $data);
    }

    public function edit_products($PID=false)
    {
        $product = $this->product->get_products_by_pid($PID);

        if (!$product) {
            redirect('bkproducts');
        }

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage']=$this->upload('products', 850);
                if($product && file_exists($product->bgimage)){
                    unlink($product->bgimage);
                }
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['pdimage']=$this->upload('products', 850,'A');
                if($product && file_exists($product->pdimage)){
                    unlink($product->pdimage);
                }
            endif;
            if (isset($_FILES['catalogFile']) && !$_FILES['catalogFile']['error']):
                $file=$this->upload('products',false,'catalog');
                $post['catalog_path']=$file['file_path'];
                $post['catalog_name']=$file['file_name'];
              if($product && file_exists($product->catalog_path)){
                    unlink($product->catalog_path);
                }
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['carouselA_image']=$this->upload('products', 850,'B');
              if($product && file_exists($product->carouselA_image)){
                    unlink($product->carouselA_image);
                }
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['carouselB_image']=$this->upload('products', 850,'C');
              if($product && file_exists($product->carouselB_image)){
                    unlink($product->carouselB_image);
                }
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['carouselC_image']=$this->upload('products', 850,'D');
              if($product && file_exists($product->carouselC_image)){
                    unlink($product->carouselC_image);
                }
            endif;
            $post['features']=json_encode($post['features']);
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_products', $post,array('PID'=>$PID));
            redirect('bkproducts');
        }
        $data = array(
        'product'=>$product
        );
        $this->get_view('edit_products', $data);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}