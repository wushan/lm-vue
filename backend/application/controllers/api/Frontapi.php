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
            'content' => str_replace("\n", "</p>\n<p>", '<p>' . $home->content . '</p>')
        );
        $data['introproduct'] = array(
            "id" => $product[0]->PID,
            "name" => $product[0]->list_name,
            "model" => $product[0]->model,
            "image" => $product[0]->pdimage,
            "description" => $product[0]->intro,
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
            'contentA' => $about->contentA,
            'titleB' => $about->contentB,
            'contentB' => $about->contentC,
            'imageB' => base_url($about->imageC),
            'titleC' => $about->contentD_title,
            'contentC' => $about->contentD,
            'imageC' => base_url($about->imageD),
            'slides' => $this->process_about_banner($about_banner),
            'contentD' => $about->contentE
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
        $id=$this->input->post('id');
        $product = $this->product->get_products_by_pid($id);
        $spec = $this->product->get_spec($product->PID);

        if ($product->which_bg == 0) {
            $product->bgimage = $product->list_image;
        }
        if ($product->carouselA_option == 0) {
            $urlA = $product->carouselA_image;
            $typeA = 'image';
        } else {
            $urlA = $product->carouselA;
            $typeA = 'video';
        }
        if ($product->carouselB_option == 0) {
            $urlB = $product->carouselB_image;
            $typeB = 'image';
        } else {
            $urlB = $product->carouselB;
            $typeB = 'video';
        }
        if ($product->carouselC_option == 0) {
            $urlC = $product->carouselC_image;
            $typeC = 'image';
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
            'backgroundimage' => $product->bgimage,
            'description' => $product->intro,
            'brochure' => base_url($product->catalog_path),
            'media' => array(array('url' => $urlA, 'type' => $typeA), array('url' => $urlB, 'type' => $typeB), array('url' => $urlC, 'type' => $typeC)),
            'features' => $this->process_product_features(json_decode($product->features)),
            'specification' => array($this->process_product_column($product->columns), $this->process_spec_column($spec)),
        );
        echo json_encode($data);
    }

    public function get_news_list()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $news = $this->news->get_news();
        $data = array(
            $this->process_news($news)
        );
        echo json_encode($data);
    }

    public function get_news_single()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $id=$this->input->post('id');
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
            'updated_time' => date('m/d/Y', strtotime($news->update_time)),
            'title' => $news->title,
            'content' => $news->content,
            'excerpt' => $news->excerpt,
            'thumbnail' => base_url($news->thumbnail),
            'pagination' => array('prev' => $prev, 'next' => $next),
            'media' => array(array('url' => $news->newsimageA), array('url' => $news->newsimageB), array('url' => $news->newsimageC), array('url' => $news->newsimageD))
        );
        echo json_encode($data);
    }

    public function get_dealer()
    {
        header("Content-Type: application/json; charset=UTF-8");

        $id=$this->input->post('id');
        $agent = $this->agt->get_agent_by_aid($id);
        $orders = $this->agt->get_order($agent->AID);

        $data = array(
            'dealername' => $agent->company,
            'dealerid' => $agent->AID,
            'orders' => $this->process_orders($orders)
        );
        echo json_encode($data);
    }

    /******************************private****************************************/
    private function process_news($news)
    {
        if ($news) {
            foreach ($news as $row) {
                $data[] = array(
                    'id' => $row->NID,
                    'created_time' => date('m/d/Y', strtotime($row->date)),
                    'updated_time' => date('m/d/Y', strtotime($row->update_time)),
                    'title' => $row->title,
                    'excerpt' => $row->excerpt,
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
                            'thumbnail' => $prow->pdimage
                        );
                    }
                }
                $data[] = array(
                    'id' => $row->PLID,
                    'name' => $row->name,
                    'description' => $row->intro,
                    'image' => $row->image,
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
                    'image' => $row->bgimage,
                    'description' => $row->intro
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
                    'description' => $features->intro[$i]
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

    private function process_spec_column($spec)
    {
        if ($spec) {
            foreach ($spec as $i => $row) {
                if ($row->PDID) {
                    foreach (json_decode($row->PDID) as $drow) {
                        $data[$i][] = array(
                            'id' => $drow,
                            'name' => $this->product->get_pd_by_pdid($drow)->model,
                            'spec' => json_decode($this->product->get_pd_by_pdid($drow)->spec)
                        );
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
                            "description" => $drow->decription,
                            "filepath" => base_url($drow->file_path)
                        );
                    }
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

}