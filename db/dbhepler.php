<?php

require_once ('config.php');

function execute($sql) { // danh cho tat ca cau lenh
    //save data into table
    //ket noi toi database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    // insert, update, delete
    mysqli_query($con, $sql);

    // ket thuc connect

    mysqli_close($con);
}

function executeSingleResult($sql) { // ham tra ve du lieu
    //save data into table
    //
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, 1);

        // $result =  mysqli_query($connect, $query) ; 
                    
        //             $data = array();
        //             while ($row = mysqli_fetch_array($result, 1)) {
        //                 $data[] = $row;
        //             }

        // ket thuc 
        mysqli_close($con);

        return $row;
}

function executeResult($sql) { // ham tra ve du lieu
    //save data into table
    //
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //
    $result = mysqli_query($con, $sql);
    $data = array();
    while ($row = mysqli_fetch_array($result, 1)) {
        $data[] = $row;
        }

        // $result =  mysqli_query($connect, $query) ; 
                    
        //             $data = array();
        //             while ($row = mysqli_fetch_array($result, 1)) {
        //                 $data[] = $row;
        //             }

        // ket thuc 
        mysqli_close($con);

        return $data;
}