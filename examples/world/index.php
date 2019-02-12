<?php
 require_once("php/cities.php");
 $db=new DBConnector("config.ini");
 $dao=new Cities($db,"city");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>City Lookup</title>
</head>

<body class="bg-dark">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="display-4 text-light my-5">City Lookup Tool</div>
        </div>
        <div class="row justify-content-center">
            <p class="text-light">Browse <?=$dao->count()?> cities in the <code>world</code> database!</p>
        </div>
        <form method="post">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-5 col-md-6 text-center">
                    <h5 class="text-light">Search by Country Code:</h5>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Country Code</span>
                            </div>
                            <input name="cc" type="text" class="form-control" placeholder="e.g USA" value=<?=(isset($_POST['cc'])?$_POST['cc']:"")?>>
                            <div class="input-group-append">
                            <input type="submit" name="btn_cc" class="btn btn-outline-secondary text-light" type="button" value="Search"
                                    id="button-addon2"/>
                            </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="post">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-5 col-md-6 text-center">
                    <h5 class="text-light">Search by City Name:</h5>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                            </div>
                            <input name="nm" type="text" class="form-control" placeholder="e.g New York" value="<?=(isset($_POST['nm'])?$_POST['nm']:"")?>">
                            <div class="input-group-append">
                                <input type="submit" name="btn_nm" class="btn btn-outline-secondary text-light" type="button" value="Search"
                                    id="button-addon2"/>
                            </div>
                        </div>
                </div>
            </div>
        </form>
        <div class="row px-md-5">
            <div class="col">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country Code</th>
                            <th scope="col">District</th>
                            <th scope="col">Population</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if(isset($_POST['btn_cc'])){
                                    if($_POST['cc']=="") $cities=$dao->selectAll();
                                    else $cities=$dao->selectByFilter(["CountryCode"=>$_POST['cc']]);
                                }else if(isset($_POST['btn_nm'])){
                                    if($_POST['nm']=="") $cities=$dao->selectAll();
                                    else $cities=$dao->selectByNameLike($_POST['nm']);
                                }else $cities=$dao->selectAll();
                                if($cities!=null){
                                    foreach ($cities as $city) {
                        ?>
                        <tr>
                            <th scope="row"><?=$city->getID()?></th>
                            <td><?=$city->getName()?></td>
                            <td><?=$city->getCountryCode()?></td>
                            <td><?=$city->getDistrict()?></td>
                            <td><?=$city->getPopulation()?></td>
                        </tr>
                        <?php
                                    }
                                }else{
                        ?>
                            <tr>
                            <td colspan="5" class="text-center">No cities with the applied filter 😔</td>
                            </tr>
                        <?php
                                }
                            ?>
                    </tbody>
                </table>
              <p class="text-light"><small>Showing a total of <?=count($cities)?> cities</small></p>
            </div>
        </div>
    </div>
</body>
</html>