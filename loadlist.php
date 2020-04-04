<?php

    session_start();
    include('connection.php');
    if(!isset($_SESSION['user_id'])){
        header("location: index.php");
    }

    //get the user_id
    $user_id = $_SESSION['user_id'];
    $table = $_POST['table'];
    //run a query to look for notes corresponding to user_id
    $sql = "SELECT * FROM " . $table . " WHERE user_id ='$user_id' ORDER BY vote DESC";
    //$list = '<div id="show">';
    $list = '';
    //shows notes or alert message
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $movie_id = $row['movie_id'];
                $title = $row['title'];
                $releaseyear = $row['releaseyear'];
                $posterpath = $row['posterpath'];
                $vote = $row['vote'];

                $img = "<img style='height:60px; width:50px;' src='" . $posterpath . "'></img>";
                $list .= "<div class='elementfav'><table style='background-color: white; margin: 0px;' class='table'><tr><td style='display: none;'>".$movie_id."</td><td style='text-align: left;'>".$img."</td><td style='text-align: center; vertical-align: middle;'>".$title." -- ".$releaseyear."</td><td style='text-align: right; vertical-align: middle;'>".$vote."</td></tr></table><div style='padding: 10px; color: white;' class='extras showextra'><div style='margin-top: 15px;'><h4>SYNOPSIS<hr style='border: 1px solid white;'></h4></div><div>"."</div>";

                $list .= '<div class="btn-group" role="group" style="margin: 20px auto 30px auto;" aria-label="Basic example"><button type="button" class="btn btn-danger deletefromfavorites">DELETE</button>';

                $list .= "</div></div></div>";

            }
            //$list .= "</div>";
            
            echo $list;
        /* ?>
            <script>
            console.log('Hiiiiiiooooo');
                document.getElementById("show").getElementsByClassName('elementfav').onclick = function() {
                console.log($(this).find('table').find('tr').find('td:eq(o)').text());

                };
                console.log('Hiiooiioo');
            </script>
        <?php */
        }else{
            echo '<div class="alert alert-warning">You do not have any favorites yet!</div>';
            exit;
        }
        
    }else{
        echo '<div class="alert alert-warning">An error occured!</div>'; 
        exit;
    //    echo "ERROR: Unable to excecute: $sql." . mysqli_error($link);
    }


?>