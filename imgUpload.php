<?php
    require_once("bootstrap.php");
    Session::check();

    if(!empty($_POST)){
        
//        $user_feed = $_SESSION['user'];
        $description = @$_POST["description"];
        $location = @$_POST["location"];
        $filter = $_POST["slctFilter"];

        $p = new Post();
        $p->moveImage();
        $p->getId($_SESSION['user']);
        $p->setImageFilterId($filter);
        $p->setDescription($description);
        $p->setLocation($location);
        $p->add();
    }
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body>
      	<?php require_once("includes/nav.inc.php"); ?>
        <main>
            <div class="form">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" accept="image/*" onchange="loadFile(event)" id="fileUpload"/>
                    <input type="text" name="description" id="description" placeholder="description">
                    <input type="text" name="location" id="location" placeholder="location">
                    <input type="submit" id="knop" value="upload">

                    <?php
                        if( isset($error) ) {
                            echo "<p class='error'>$error</p>";
                        }
                    ?>

                    <div class="custom-select" style="width:200px;">
                        <select id="slctFilter" name="slctFilter" onchange="filterGo(this.id)">
                            <div id="content">
                            <option value="0">Select Filter:</option>
                            <option value="_1997">1977</option>
                            <option value="aden">Aden</option>
                            <option value="brannan">Brannan</option>
                            <option value="brooklyn">Brooklyn</option>
                            <option value="clarendon">Clarendon</option>
                            <option value="earlybird">Earlybird</option>
                            <option value="gingham">Gingham</option>
                            <option value="hudson">Hudson</option>
                            <option value="inkwell">Inkwell</option>
                            <option value="kelvin">Kelvin</option>
                            <option value="lark">Lark</option>
                            <option value="lofi">Lofi</option>
                            <option value="maven">Maven</option>
                            <option value="mayfair">Mayfair</option>
                            <option value="moon">Moon</option>
                            <option value="nashville">Nashville</option>
                            <option value="perpetua">Perpetua</option>
                            <option value="reyes">Reyes</option>
                            <option value="rise">Rise</option>
                            <option value="slumber">Slumber</option>
                            <option value="stinson">Stinson</option>
                            <option value="toaster">Toaster</option>
                            <option value="valencia">Valencia</option>
                            <option value="walden">Walden</option>
                            <option value="willow">Willow</option>
                            <option value="xpro2">Xpro2</option>
                            </div>
                        </select>
                    </div>
                </form>
            </div>
            <img class="" id="output" />
        </main>
        <script>
            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
        </script>
        <script>
            function filterGo(d1) {
                var d1 = document.getElementById(d1);
                var output = document.getElementById('output');

                if(d1.value == '_1997'){
                    output.className='_1997';
                }else if(d1.value == 'aden'){
                    output.className='aden';
                }else if(d1.value == 'brannan'){
                    output.className='brannan';
                }else if(d1.value == 'brooklyn'){
                    output.className='brooklyn';
                }else if(d1.value == 'clarendon'){
                    output.className='clarendon';
                }else if(d1.value == 'earlybird'){
                    output.className='earlybird';
                }else if(d1.value == 'gingham'){
                    output.className='gingham';
                }else if(d1.value == 'hudson'){
                    output.className='hudson';
                }else if(d1.value == 'inkwell'){
                    output.className='inkwell';
                }else if(d1.value == 'kelvin'){
                    output.className='kelvin';
                }else if(d1.value == 'lark'){
                    output.className='lark';
                }else if(d1.value == 'lofi'){
                    output.className='lofi';
                }else if(d1.value == 'maven'){
                    output.className='maven';
                }else if(d1.value == 'mayfair'){
                    output.className='mayfair';
                }else if(d1.value == 'moon'){
                    output.className='moon';
                }else if(d1.value == 'nashville'){
                    output.className='nashville';
                }else if(d1.value == 'perpetua'){
                    output.className='perpetua';
                }else if(d1.value == 'reyes'){
                    output.className='reyes';
                }else if(d1.value == 'rise'){
                    output.className='rise';
                }else if(d1.value == 'slumber'){
                    output.className='slumber';
                }else if(d1.value == 'stinson'){
                    output.className='stinson';
                }else if(d1.value == 'toaster'){
                    output.className='toaster';
                }else if(d1.value == 'valencia'){
                    output.className='valencia';
                }else if(d1.value == 'walden'){
                    output.className='walden';
                }else if(d1.value == 'willow'){
                    output.className='willow';
                }else if(d1.value == 'xpro2'){
                    output.className='xpro2';
                }else{
                    output.className='';
                }
            }
        </script>
    </body>
</html>