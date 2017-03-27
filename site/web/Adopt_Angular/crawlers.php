<?php
$id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);
$SITE_ROOT = 'http://animalfoundation.com/ngservice/example/example_adopt.php?d=http%3A%2F%2Fwww.petharbor.com%2Fdetail.asp%3FID%3D'.$id.'%26LOCATION%3DLSVG%26searchtype%3DID%26start%3D4%26stylesheet%3Dinclude%2Fdefault.css%26frontdoor%3D1%26friends%3D1%26samaritans%3D1%26nosuccess%3D0%26rows%3D24%26imght%3D120%26imgres%3Ddetail%26tWidth%3D200%26view%3Dsysadm.v_animal%26nomax%3D1%26fontface%3Darial%26fontsize%3D10%26miles%3D20%26lat%3D36.194168%26lon%3D-115.22206%26shelterlist%3D%2527LSVG%2527%26atype%3D%26where%3DID_'.$id;

$jsonData = getData($SITE_ROOT);
// echo $jsonData;
makePage($jsonData, $SITE_ROOT);
function getData($siteRoot) {
    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);
    // echo $id;
    $rawData = file_get_contents($siteRoot);
    return json_decode($rawData);
}

function makePage($data, $siteRoot) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta property="og:title" content="<?php echo $data[0]->name; ?>" />
            <meta property="og:description" content="<?php echo strip_tags($data[0]->debug); ?>" />
            <meta property="og:image" content="<?php echo $data[0]->image; ?>" />
            <!-- etc. -->
        </head>
        <body>
            <h1><?php echo $data[0]->name; ?></h1>
            <p><?php echo $data[0]->debug; ?></p>
            <img src="<?php echo $data[0]->image; ?>">
        </body>
    </html>
    <?php
}
?>