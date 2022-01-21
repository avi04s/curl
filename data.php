<?php
    require_once 'simple_html_dom.php';
    
   // echo json_encode($_POST['path']);

    $url = "https://books.toscrape.com/".$_POST['path'];
   // echo json_encode($url);
    //$html = file_get_html('https://books.toscrape.com/catalogue/a-light-in-the-attic_1000/index.html');

   $html = file_get_html($url);

    $result = array();
   // $outout= array();

    $div_class = $title = "";
    $desc="";
    $data1="";
    $tr="";
    $td="";


    $i = 0;
    $j=0;
    $k=0;



        
        if(!empty($html)){


            foreach($html->find(".product_main") as $div_class){
        

                
                foreach($div_class->find('h1') as $title){
                    $results[$i]['title'] =$title->plaintext;
        
                   // echo $results[$i]['title'].'<br>';

                   $title = $results[$i]['title'];
        
                }

                
                foreach($div_class->find('.price_color') as $price){
                    $results[$j]['price'] = $price->plaintext;
        
                   // echo $results[$i]['title'].'<br>';

                    $price = $results[$i]['price'];
        
                }

              /*  print_r(
                    json_encode(
                        array('data' => $data1)
                    )
                    );*/

            /*    print_r(
                    json_encode(
                        array(
                            'title' =>$title,
                            'price' =>$price,
                           // 'desc' =>$desc,
                            'info' =>$info
                        )
                    )
                        );*/

              //echo json_encode($output);


                $i++;
                $j++;
                
            }

            
            foreach($html->find('p') as $desc){

              //  foreach($div->find('p') as $desc){
                    $results[$i]['desc'] =$desc->plaintext;
        
                   // echo $results[$i]['title'].'<br>';

                   $desc = $results[$i]['desc'];
        
                //}

                
            }

            foreach($html->find(".product_page") as $div_class1){


                foreach($div_class1->find('.table') as $table){

                  //  $results[$k]['table'] = $table->plaintext;
                 //   $data1 = $results[$k]['table'];

                    foreach($table->find('th') as $tr){

                        //$results[$k]['tr'] =$tr->plaintext;
                        $tr1[] = $tr->plaintext;
                      
                    }

                   foreach($table->find('td') as $td){

                        
                        $td1[] =$td->plaintext;
                        

                    }
                   // $results[$i]['title'] =$title->plaintext;

        
                  //  echo $results[$i]['title'].'<br>';

                  // $title = $results[$i]['title'];

         
        
                }

                
            

                $k++;

            }


               print_r(
                    json_encode(
                        array(
                            'title' =>$title,
                            'price' =>$price,
                            'desc' =>$html->find('p',3)->plaintext,
                            'td1' =>$td1,
                            'tr1' =>$tr1,
                        )
                    )
                        );

        }
        else{

            print_r(json_encode(array(
                "html"=> "ELSE",
            )));

        }





  

?>