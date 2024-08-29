<?php

$koneksi = mysqli_connect("localhost", "root", "", "e_complaint_vokasi");


if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM faq";
$result = mysqli_query($koneksi, $sql);


if (mysqli_num_rows($result) > 0) {
    $faqs = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $faqs = [];
}


mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FAQ</title>
    <link rel="stylesheet" href="../css/faq.css"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
</head>
<body>
<div class="wrapper">
    <p></p>
    <h1>FAQ E-COMPLAINT</h1>

    <hr></hr>

    <?php foreach ($faqs as $faq): ?>
    <?php $uniqueId = 'faq-' . $faq['id_faq'] ; ?>
    <div class="panel-default" style="margin-bottom: 10px;">
        <button class="accordion" id="<?php echo $uniqueId; ?>">
            <?php echo $faq['pertanyaan']; ?>
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" style="margin-bottom: 10px;" id="<?php echo $uniqueId; ?>-panel">
            <p>
                <?php echo $faq['jawaban']; ?>
            </p>
        </div>
    </div>
    <?php endforeach; ?>
    
    <script>
        var acc = document.querySelectorAll(".accordion");
        acc.forEach(function (item) {
            item.addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = document.getElementById(this.id + '-panel');
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        });
    </script>
</body>
</html>