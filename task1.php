<?php

$curl = curl_init(); 
require_once 'simple_html_dom.php';

$html = file_get_html('https://books.toscrape.com/', false);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
$result = array();



   /* foreach($html->find(".product_pod") as $div_class){
        

        foreach($div_class->find('img') as $image){
            $results[$i]['image'] =$image->src;

          //  echo $results[$i]['image'].'<br>';

        }


        
        foreach($div_class->find("h3") as $title){

            $results[$i]['title'] = $title->plaintext;

            //echo $results[$i]['title'].'<br>';

        }



        foreach($div_class->find(".price_color") as $price){

            $results[$i]['price'] = $price->plaintext;

           // echo $results[$i]['price'].'<br>';

        }

      
        $i++;
        
    
    }*/


//print_r($result);


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <?php 

        if(!empty($html)){

            $div_class = $title = "";
            $i = 0;

            foreach($html->find(".product_pod") as $div_class){

              foreach($div_class->find(".price_color") as $price){

                $results[$i]['price'] = $price->plaintext;

                 // echo $results[$i]['price'].'<br>';

             }

             
            foreach($div_class->find('img') as $image){
                $results[$i]['image'] =$image->src;

            //  echo $results[$i]['image'].'<br>';

            }

            foreach($div_class->find('a') as $link){
                $results[$i]['link'] =$link->href;

            //  echo $results[$i]['image'].'<br>';

            }
            
                foreach($div_class->find("h3") as $title){

                    $results[$i]['title'] = $title->plaintext;
          ?>
            <div class="col-lg-4">

                <div class="card" style="" onclick="getData('<?php echo $results[$i]['link']; ?>')" data-toggle="modal" data-target="#exampleModal">
                    <img class="card-img-top" src=<?php echo "https://books.toscrape.com/".$results[$i]['image'];?>
                        alt="Card image cap" style="height:250px;">
                    <div class="card-body">
                        <?php echo $results[$i]['title']; ?> <br>
                        <?php echo $results[$i]['price']; ?> <br>
                       
                       

                    </div>
                </div>

            </div>
            </button>

            <?php }
                $i++;
            } }?>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="output">
            <span>
                Title : <span id="title"></span>
            </span>
            <br>
            <span>
                Price : <span id="price"></span>
            </span>
            <br>
            <span>
                Description : <span id="desc"></span>
            </span>
            <br>
            <span>Product Info</span>
            <br>
            <span>
                UPC : <span id="1"></span><br>
            </span>
            <span>
                Product Type: <span id="2"></span><br>
            </span>
            <span>
                Price (excl. tax) : <span id="3"></span><br>
            </span>
            <span>
                Price (incl. tax) <span id="4"></span><br>
            </span>
            <span>
                Tax : <span id="5"></span><br>
            </span>
            <span>
                Availability : <span id="6"></span><br>
            </span>
            <span>
                Number of reviews : <span id="7"></span><br>
            </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 



   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    function getData(path){
        //alert(path);

          // ajax
          $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: {
                        path: path,
                    },
                    dataType: 'json',
                    success: function(response) {

                        
                        document.getElementById('title').innerHTML=response.title;
                        document.getElementById('price').innerHTML=response.price;
                        document.getElementById('desc').innerHTML=response.desc;

                        document.getElementById('1').innerHTML=response.td1[0];
                        document.getElementById('2').innerHTML=response.td1[1];

                       // document.getElementById('output').innerHTML=response.tr1[0];
                       // console.warn("title:",response.title,", Price",response.price);
                      // console.warn("res",response);

                      /*  var response = $.parseJSON(response);
                        var html = response.html;
                        console.warn("Result",html); */
                    }
            });


    }
      /*  $(document).ready(function($) {
           
            $('body').on('click', '.card', function() {

                var path = $("input[name='path']").val();
               // alert(path);


               
                // ajax
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: {
                        path: path,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.warn("Result",res);
                    }
                });
        });

        });*/
    </script>

    

</body>

</html>