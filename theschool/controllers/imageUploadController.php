<?php
$name = $_POST['name'];
if (isset($_FILES['image'])) {
            $root = '../uploads/' . basename($name . $_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $root)) {
        echo $root;
    } else {
        echo "ERR";
    }
}        