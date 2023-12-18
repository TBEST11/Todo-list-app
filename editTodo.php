<?php

require "./db.php";

if (isset($_POST["editTodoBtn"])) {
    return editTodoItem($conn, $_POST);
}

if (isset($_POST["deleteTodoBtn"])) {
    return deleteTodo($conn, $_POST["id"]);
}

function editTodoItem($conn, $data)
{
    $id = $data['id'];

    $activity = $data['activity'];
    $status = $data['status'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $description = $data['description'];

    if (!empty($activity) || !empty($status) || !empty($start_date) || !empty($end_date) || !empty($description)) {
        $sql = "UPDATE `todo` SET `activity`='$activity', `status`='$status', `start_date`='$start_date', `end_date`='$end_date', `description`='$description' WHERE `id`='$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header("Location: view.php");
        } else {
            echo "😉😉😉✌";
        }
    }
}

function deleteTodo($conn, $id)
{

    $sql = ("DELETE FROM `todo`  WHERE `id`='$id'");
    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("Location: view.php");
    } else {
        echo "😉😉😉✌";
    }
}
