<?php

require_once ("DB.php");
require_once ("Components.php");

$con = CreateDb();

if (isset($_POST['create'])){
   Data();
}

if (isset($_POST['update'])){
    Update();
}

if (isset($_POST['delete'])){
    Delete();
}

if (isset($_POST['deleteall'])){
    DeleteAll();
}



//Data
function Data()
{
    $stuff_name      = TextValue("stuff_name");
    $stuff_publisher = TextValue("stuff_publisher");
    $stuff_price     = TextValue("stuff_price");
    
    if($stuff_name && $stuff_publisher && $stuff_price){

        $sql = "INSERT INTO stuff(stuff_name, stuff_publisher, stuff_price)
               VALUE ('$stuff_name', '$stuff_publisher', '$stuff_price')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            ShowText('success', 'Inserted successfully');
        }else{
            echo "Error";
        }

    }else{
        ShowText('error', 'Data Needed');
    }
}

//Validate
function TextValue($value)
{
    $textValue  = mysqli_real_escape_string($GLOBALS['con'], trim(stripslashes(htmlspecialchars($_POST[$value]))));

    if (empty($textValue)){
        return false;
    }else{
        return $textValue;
    }

}

//Massage
function ShowText($class, $Massage)
{
    $elm = "<h6 class='$class'>$Massage</h6>";
    echo $elm;
}

//Get data
function GetData()
{
    $sql = "SELECT * FROM stuff";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if (mysqli_num_rows($result) > 0){
       return $result;
    }
}

function Update()
{
    $stuffID    = TextValue("stuff_id");
    $stuffName  = TextValue("stuff_name");
    $stuffPub   = TextValue("stuff_publisher");
    $stuffPrice = TextValue("stuff_price");

    if ($stuffID && $stuffName && $stuffPub && $stuffPrice){

        $sql = "
            UPDATE stuff SET stuff_name='$stuffName', stuff_publisher='$stuffPub',
            stuff_price='$stuffPrice' WHERE id='$stuffID';
        ";

        if (mysqli_query($GLOBALS['con'], $sql)){
           ShowText('success', 'Data Updated');
        }else{
            ShowText('Error', 'Something went Wrong');
        }
    }else{
            ShowText('Error', 'Select Data');
    }
}


function Delete()
{
    $stuffID = (int)TextValue('stuff_id');

    $sql     = "DELETE FROM stuff WHERE id='$stuffID'";

    if (mysqli_query($GLOBALS['con'], $sql)){
        ShowText('Success', 'Data Deleted');
    }else{
        ShowText('Error', 'Cant Delete record');
    }
}

function DeleteBtn()
{
    $result = GetData();
    $i = 0;
    if ($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if ($i > 3){
                ButtonElement("btn-deleteall", 'btn btn-danger',
                "<i class='fas fa-trash'></i> Delete All", "deleteall", "");
            }
        }
    }
}


function DeleteAll()
{
    $sql = "DROP TABLE stuff";

    if (mysqli_query($GLOBALS['con'], $sql)){
        ShowText('Success', 'Data All Deleted');
        CreateDb();
    }else{
        ShowText('Error', 'Something went Wrong');
    }
}

function SetID()
{
    $getID = GetData();
    $id    = 0;
    if ($getID){
        while ($row = mysqli_fetch_assoc($getID)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}