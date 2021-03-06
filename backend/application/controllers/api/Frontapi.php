<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontapi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tb_home_model', 'home');
        $this->load->model('tb_product_model', 'product');
        $this->load->model('tb_news_model', 'news');
        $this->load->model('tb_about_model', 'about');
        $this->load->model('tb_agent_model', 'agt');
        $this->load->model('tb_inventory_model', 'inventory');
        $this->load->model('tb_error_model', 'error');
        $this->load->model('tb_captcha_model', 'captcha');
        $this->load->model('tb_inventory_model','inventory');
    }

    public function get_homepage()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $home = $this->home->home_get();
        $product = $this->product->get_products(false, true);
        $news = $this->news->get_news(true);

        $data['introbrand'] = array(
            'title' => $home->title,
            'background' => base_url($home->image),
            'contentheader' => $home->content_title,
            'content' => str_replace("\n", "</p>\n<p>", $home->content . '</p>')
        );
        $data['introproduct'] = array(
            "id" => $product[0]->PID,
            "name" => $product[0]->list_name,
            "model" => $product[0]->model,
            "image" => base_url($product[0]->pdimage),
            "description" => str_replace("\n", "</p>\n<p>", $product[0]->intro . '</p>'),
        );
        $data['intronews'] = $this->process_news($news);
        echo json_encode($data);
    }

    public function get_about()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $about = $this->about->about_get();
        $about_banner = $this->about->about_banner_get();
        $data = array(
            'titleA' => $about->contentA_title,
            'contentA' => str_replace("\n", "</p>\n<p>", $about->contentA . '</p>'),
            'titleB' => $about->contentB,
            'contentB' => str_replace("\n", "</p>\n<p>", $about->contentC . '</p>'),
            'imageB' => base_url($about->imageC),
            'titleC' => $about->contentD_title,
            'contentC' => str_replace("\n", "</p>\n<p>", $about->contentD . '</p>'),
            'imageC' => base_url($about->imageD),
            'slides' => $this->process_about_banner($about_banner),
            'contentD' => str_replace("\n", "</p>\n<p>", $about->contentE . '</p>')
        );
        echo json_encode($data);
    }

    public function get_product_category()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $product = $this->product->get_products(false, false, true);
        $plist = $this->product->get_product_list();

        $data = array(
            'categories' => $this->process_product_list($plist),
            'highlightproduct' => $this->process_product($product)
        );
        echo json_encode($data);
    }

    public function get_product_single()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $id = $this->input->post('id');
        $product = $this->product->get_products_by_pid($id);
        $spec = $this->product->get_spec($product->PID);

        if ($product->which_bg == 0) {
            $product->bgimage = $product->list_image;
        }
        if ($product->carouselA_option == 0) {
            if ($product->carouselA_image) {
                $urlA = base_url($product->carouselA_image);
                $typeA = 'image';
            }
        } else {
            $urlA = $product->carouselA;
            $typeA = 'video';
        }
        if ($product->carouselB_option == 0) {
            if ($product->carouselB_image) {
                $urlB = base_url($product->carouselB_image);
                $typeB = 'image';
            }
        } else {
            $urlB = $product->carouselB;
            $typeB = 'video';
        }
        if ($product->carouselC_option == 0) {
            if ($product->carouselC_image) {
                $urlC = base_url($product->carouselC_image);
                $typeC = 'image';
            }
        } else {
            $urlC = $product->carouselC;
            $typeC = 'video';
        }

        $data = array(
            'id' => $product->PID,
            'name' => $product->name,
            'model' => $product->model,
            'category' => array('name' => $product->list_name, 'id' => $product->PLID),
            'image' => base_url($product->pdimage),
            'backgroundimage' => base_url($product->bgimage),
            'description' => str_replace("\n", "</p>\n<p>", $product->intro . '</p>'),
            'brochure' => base_url($product->catalog_path),
//            'media' => array(array('url' => $urlA, 'type' => $typeA), array('url' => $urlB, 'type' => $typeB), array('url' => $urlC, 'type' => $typeC)),
            'features' => $this->process_product_features(json_decode($product->features)),
            'specification' => array('columns' => $this->process_product_column($product->columns), 'models' => $this->process_spec_column($spec,$product->columns)),
        );
        if (isset($urlA)) {
            $data['media'][0] = array('url' => $urlA, 'type' => $typeA);
        }
        if (isset($urlB)) {
            $data['media'][1] = array('url' => $urlB, 'type' => $typeB);
        }
        if (isset($urlC)) {
            $data['media'][2] = array('url' => $urlC, 'type' => $typeC);
        }
        echo json_encode($data);
    }

    public function get_news_list()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $news = $this->news->get_news();
        $data = $this->process_news($news);
        echo json_encode($data);
    }

    public function get_news_single()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $id = $this->input->post('id');
        $news = $this->news->get_news_by_nid($id);
        $prev = $this->news->get_news_prev($news->date);
        $next = $this->news->get_news_next($news->date);
        if ($prev) {
            $prev = array('id' => $prev->NID, 'title' => $prev->title);
        }
        if ($next) {
            $next = array('id' => $next->NID, 'title' => $next->title);
        }

        $data = array(
            'id' => $news->NID,
            'created_time' => date('m/d/Y', strtotime($news->date)),
            'updated_time' => date('m/d/Y', strtotime($news->date)),
            'title' => $news->title,
            'content' => str_replace("\n", "</p>\n<p>", $news->content . '</p>'),
            'excerpt' => str_replace("\n", "</p>\n<p>", $news->excerpt . '</p>'),
            'thumbnail' => base_url($news->thumbnail),
            'pagination' => array('prev' => $prev, 'next' => $next),
//            'media' => array(array('url' => base_url($news->newsimageA)), array('url' => base_url($news->newsimageB)), array('url' => base_url($news->newsimageC)), array('url' => base_url($news->newsimageD)))
        );
        if (isset($news->newsimageA)) {
            $data['media'][] = array('url' => base_url($news->newsimageA));
        }
        if (isset($news->newsimageB)) {
            $data['media'][] = array('url' => base_url($news->newsimageB));
        }
        if (isset($news->newsimageC)) {
            $data['media'][] = array('url' => base_url($news->newsimageC));
        }
        if (isset($news->newsimageD)) {
            $data['media'][] = array('url' => base_url($news->newsimageD));
        }
        echo json_encode($data);
    }

    public function get_dealer()
    {
        header("Content-Type: application/json; charset=UTF-8");

        $AID = $this->input->post('id');
        $is_login = $this->input->post('is_login');
        $agent=$this->agt->get_is_login($AID,$is_login);
        if($agent){
//            $id = $this->input->post('id');
            $agent = $this->agt->get_agent_by_aid($AID);
            $orders = $this->agt->get_order($agent->AID);
            $data = array(
                'dealername' => $agent->company,
                'dealerid' => $agent->AID,
                'orders' => $this->process_orders($orders)
            );
            echo json_encode($data);
        }else{
            echo false;
            return;
        }

    }

    public function get_inventory()
    {
        header("Content-Type: application/json; charset=UTF-8");

        $inventory = $this->inventory->get_inventory();
        $data = $this->process_inventory($inventory);
        echo json_encode($data);
    }


    public function get_machine()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $AID = $this->input->post('id');
        $is_login = $this->input->post('is_login');
        $agent=$this->agt->get_is_login($AID,$is_login);
        if($agent){
//            $id = $this->input->post('id');
            $agent = $this->agt->get_agent_by_aid($AID);
            $buy = $this->process_agent_buy($agent->buy);
            $data = $buy;
            echo json_encode($data);
        }else{
            echo false;
            return;
        }
    }


    public function get_errorshooting()
    {
        header("Content-Type: application/json; charset=UTF-8");
        header('Cache-Control: no-cache, must-revalidate');
        $AID = $this->input->post('id');
        $is_login = $this->input->post('is_login');
        $agent=$this->agt->get_is_login($AID,$is_login);
        if($agent){
//            $id = $this->input->post('id');
            $errorcode = $this->input->post('errorcode');
            $mid = $this->input->post('mid');
            $agent = $this->agt->get_agent_by_aid($AID);
            $buy = $this->process_agent_buy($agent->buy);
            $error_code = $this->error->get_search_error_code($errorcode);
            $get_agent_model = $this->process_model($buy, $error_code,$mid);

            $data = $get_agent_model;
            echo json_encode($data);
        }else{
            header('HTTP/1.1 404 Not Found');
            $data=array(
                'status' => FALSE,
                'error' => 'Search Failed',
            );
            echo json_encode($data);
        }

    }

    public function get_captcha(){
        header("Content-Type: application/json; charset=UTF-8");
        $this->captcha->delete_captcha();
        $this->captcha->get_captcha();
        $captcha=rand(1000, 9999);
        $this->db->insert('tb_captcha',array('cap'=>$captcha,'create_time'=>date('Y-m-d H:i:s')));
        echo json_encode($captcha);
    }

    public function get_login(){
        header("Content-Type: application/json; charset=UTF-8");
        header('Cache-Control: no-cache, must-revalidate');
        $account = $this->input->post('account');
        $password = $this->input->post('password');
        $captcha = $this->input->post('captcha');
        $agent=$this->agt->get_login_agent($account,$password);
        $captcha=$this->captcha->get_login_captcha($captcha);
        if($agent && $captcha){
           $login=uniqid();
           $this->db->update('tb_agent',array('is_login'=>$login),array('AID'=>$agent->AID));
            $agent->is_login=$login;
            $data=array(
                'id'=>$agent->AID,
                'name'=>$agent->company,
                'is_login'=>$agent->is_login
            );
            echo json_encode($data);
        }else{
            header('HTTP/1.1 401 Unauthorized');
            $data=array(
                'status' => FALSE,
                'error' => 'Login Failed',
            );
            echo json_encode($data);
        }
    }

    public function get_is_login(){
        header("Content-Type: application/json; charset=UTF-8");
        header('Cache-Control: no-cache, must-revalidate');
        $AID = $this->input->post('id');
        $is_login = $this->input->post('is_login');
        $agent=$this->agt->get_is_login($AID,$is_login);
        if($agent){
            http_response_code(200);
            echo json_encode('success');
        }else{
            header('HTTP/1.1 401 Auth Failed');
            $data=array(
                'status' => FALSE,
                'error' => 'Auth Failed',
            );
            echo json_encode($data);
        }

    }

    public function get_contact(){
        header("Content-Type: application/json; charset=UTF-8");
        if ($post = $this->input->post('data')) {  //欄位名稱:name,email,phone,company,country,subject,message,is_allow  //is_allow 傳0 or 1 即可
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_contact_list',$post);
        }
        return false;
    }

    public function get_inquiry_item(){
        header("Content-Type: application/json; charset=UTF-8");
        $pid = $this->input->post('pid');
        $inid = $this->input->post('inid');
        if($pid){
            foreach(json_decode($pid) as $prow){
                $category[]=array(
                    'id'=>$this->product->get_products_by_pid($prow)->PID,
                    'image'=>base_url($this->product->get_products_by_pid($prow)->pdimage),
                    'name'=>$this->product->get_products_by_pid($prow)->name
                );
            }
        }else{
            $category=array();
        }
        if($inid){
            foreach(json_decode($inid) as $irow){
                $inventory[]=array(
                    'id'=> $this->inventory->get_inventory_by_inid($irow)->INID,
                    'image'=>base_url($this->inventory->get_inventory_by_inid($irow)->image),
                    'name'=>$this->inventory->get_inventory_by_inid($irow)->name
                );

            }
        }else{
            $inventory=array();
        }
        echo json_encode($data=array('inventory'=>$inventory,'category'=>$category));
        return false;
    }

    public function get_inquiry(){
        if ($post = $this->input->post('data')) {  //欄位名稱:pid,inid,name,email,phone,company,country,subject,message,is_allow  //is_allow 傳0 or 1 即可 ,pid 是分類id ,inid是現貨id
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_inquiry',$post);
        }
        return false;
    }

    public function error_report(){
        header("Content-Type: application/json; charset=UTF-8");
        if ($post = $this->input->post()) {
            if (isset($_FILES['errorFile']) && !$_FILES['errorFile']['error']):  //檔案上傳欄位名稱為 "errorFile"
                $file = $this->upload('errorReport', false, 'error');           //欄位名稱:errors 型態為json
                $post['file_path'] = $file['file_path'];
                $post['file_name'] = $file['file_name'];
            endif;
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_error_report',$post);
        }
        return false;
    }

    /******************************private****************************************/
    private function process_news($news)
    {
        if ($news) {
            foreach ($news as $row) {
                $data[] = array(
                    'id' => $row->NID,
                    'created_time' => date('m/d/Y', strtotime($row->date)),
                    'updated_time' => date('m/d/Y', strtotime($row->date)),
                    'title' => $row->title,
                    'excerpt' => str_replace("\n", "</p>\n<p>", $row->excerpt . '</p>'),
                    'thumbnail' => base_url($row->thumbnail)
                );
            }
            return $data;
        }
        return false;
    }

    private function process_about_banner($about_banner)
    {
        if ($about_banner) {
            foreach ($about_banner as $row) {
                $data[] = array(
                    'image' => base_url($row->image),
                    'title' => $row->title
                );
            }
            return $data;
        }
        return false;
    }

    private function process_product_list($plist)
    {
        if ($plist) {
            foreach ($plist as $row) {
                if ($row->products) {
                    foreach ($row->products as $i => $prow) {
                        $row->products[$i] = array(
                            'id' => $prow->PID,
                            'name' => $prow->name,
                            'thumbnail' => base_url($prow->pdimage)
                        );
                    }
                }
                $data[] = array(
                    'id' => $row->PLID,
                    'name' => $row->name,
                    'description' => str_replace("\n", "</p>\n<p>", $row->intro . '</p>'),
                    'image' => base_url($row->image),
                    'products' => $row->products
                );
            }
            return $data;
        }
        return false;
    }

    private function process_product($product)
    {
        if ($product) {
            foreach ($product as $row) {
                $data[] = array(
                    'id' => $row->PID,
                    'name' => $row->name,
                    'model' => $row->model,
                    'category' => array('name' => $row->list_name, 'id' => $row->PLID),
                    'image' => base_url($row->bgimage),
                    'description' => str_replace("\n", "</p>\n<p>", $row->intro . '</p>')
                );
            }
            return $data;
        }
        return false;
    }

    private function process_product_features($features)
    {
        if ($features) {
            for ($i = 0; $i < count($features->title); $i++) {
                $data[] = array(
                    'title' => $features->title[$i],
                    'description' => str_replace("\n", "</p>\n<p>", $features->intro[$i] . '</p>')
                );
            }
            return $data;
        }
        return false;
    }

    private function process_product_column($columns)
    {
        if ($columns) {
            foreach ($columns as $row) {
                $data[] = array(
                    'name' => $row->title
                );
            }
            return $data;
        }
        return false;
    }

    private function process_spec_column($spec,$column)
    {
        if ($spec) {
            foreach ($spec as $i => $row) {
                if ($row->PDID) {
                    foreach (json_decode($row->PDID) as $x => $drow) {
                        $data[$i][] = array(
                            'id' => $drow,
                            'name' => $this->product->get_pd_by_pdid($drow)->model,

                        );
                        $spec = json_decode($this->product->get_pd_by_pdid($drow)->spec);
                        if ($spec) {
                            foreach ($spec as $sprow) {
                                if ($sprow) {
                                    foreach ($sprow as $models) {
                                        $data[$i][$x]['models'][] = $models;
                                    }
                                }
                            }
                        }else{
                          for($q=0;$q<count($column);$q++){
                              $data[$i][$x]['models'][] ='';
                          }
                        }
                    }
                }
            }
            return $data;
        }
        return false;
    }

    private function process_orders($orders)
    {
        if ($orders) {
            foreach ($orders as $row) {
                $detail = $this->agt->get_order_detail($row->OID);
                if ($detail) {
                    foreach ($detail as $drow) {
                        $darray[] = array(
                            "date" => date('m/d/Y', strtotime($drow->detail_date)),
                            "contact" => $drow->contact_name,
                            "part" => $drow->machine_part,
                            "subject" => $drow->subject,
                            "description" => str_replace("\n", "</p>\n<p>", $drow->decription . '</p>'),
                            "filepath" => base_url($drow->file_path)
                        );
                    }
                } else {
                    $darray = null;
                }
                $data[] = array(
                    "id" => $row->OID,
                    "no" => $row->serial_number,
                    "date" => date('m/d/Y', strtotime($row->order_date)),
                    "expire" => date('m/d/Y', strtotime($row->warranty_date)),
                    "name" => $row->machine_model,
                    "detail" => $darray
                );
            }
            return $data;
        }
        return false;
    }

    private function process_inventory($inventory)
    {
        if ($inventory) {
            foreach ($inventory as $row) {
                $data[] = array(
                    'id' => $row->INID,
                    'name' => $row->name,
                    'description' => str_replace("\n", "</p>\n<p>", $row->content . '</p>'),
                    'image' => base_url($row->image)
                );
            }
            return $data;
        }
        return false;
    }

    private function process_agent_buy($buy)
    {
        if ($buy = json_decode($buy)) {
            foreach ($buy as $row) {
                $pd = $this->product->get_pd_by_pdid($row);

                if ($pd != null) {
                    $list = $this->product->get_products_by_pid($pd->PID);
                    $data[] = array(
                        'id' => $pd->PDID,
                        'name' => $pd->model,
                        'category' => $list->name,
                    );
                }
            };
            return $data;
        }
        return false;
    }

    private function process_model($buy, $error_code,$mid)
    {
        $modelID = json_decode($error_code->modelID);
        $error = $this->error->get_error($error_code->ECID, '0', true);
        if ($buy) {
            foreach ($buy as $row) {
                if (in_array($row['id'], $modelID) && $row['id']==$mid) {
                    $data = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'error' => array(
                            'code' => $error_code->errorCode,
                            'steps' => $error

                        )
                    );
                }
            }
            return $data;
        }
        return false;
    }

}