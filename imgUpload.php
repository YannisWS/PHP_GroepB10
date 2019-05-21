<?php
    require_once("bootstrap.php");
    Session::check();
	require_once("includes/checklogin.inc.php");

    if(!empty($_POST)){
        try{
            $description = @$_POST["description"];
            $location = @$_POST["location"];
            $filter = $_POST["slctFilter"];
            $userId = $_SESSION['user'];

            $p = new Post();
            $p->moveImage();
            $p->getUserId($userId);
            $p->setDescription($description);
            $p->setLocation($location);
            $p->setImageFilterId($filter);
            $p->add();
        }catch(Exception $e) {
            //Catch Statement
        }finally{
            header("Location: index.php");
        }
		
//		header("Location: index.php");
    }
?>
<!doctype html>
<html lang="en">
	<?php require_once("includes/header.inc.php"); ?>
    <body class="partials_upload">
      	<?php require_once("includes/nav.inc.php"); ?>
        <main>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="file" accept="image/*" onchange="loadFile(event)" id="fileUpload" required>
				<input type="text" name="description" id="description" placeholder="description" required>
				<input type="text" name="location" id="location" placeholder="location" required>
				
				<?php if(isset($error)){echo "<p class='error'>$error</p>";} ?>

				<div class="custom-select" style="width:200px;">
					<select id="slctFilter" name="slctFilter" onchange="filterGo(this.id)" required>
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
				
				<input type="submit" id="knop" value="upload">
			</form>
            
        </main>
        <figure>
        	<img class="" id="output"/>
        </figure>
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