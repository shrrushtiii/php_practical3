<?php 
session_start(); 
include "db.php"; 
require "vendor/autoload.php"; 
 
$uid = $_SESSION["uid"]; 
 
$sql = $conn->prepare("select * from products where uid=?"); 
$sql->bind_param("i", $uid); 
$sql->execute(); 
 
$result = $sql->get_result(); 
 
$pdf = new TCPDF(); 
 
$pdf->AddPage(); 
 
$pdf->SetFont("times", "B", 18); 
$pdf->Cell(0, 10, "MY PRODUCTS", 0, 1, "C"); 
 
$pdf->Ln(5); 
 
$pdf->SetFont("times", "I", 15); 
 
$html = '<table border="1" cellpadding="5"> 
<tr> 
<td><b>ID</b></td> 
<td><b>NAME</b></td> 
<td><b>CATEGORY</b></td> 
<td><b>PRICE</b></td> 
<td><b>QUANTITY</b></td> 
</tr>'; 
 
while ($row = $result->fetch_assoc()) { 
 
    $html .= '<tr> 
    <td>' . $row["pid"] . '</td> 
    <td>' . $row["pname"] . '</td> 
    <td>' . $row["category"] . '</td> 
    <td>' . $row["price"] . '</td> 
    <td>' . $row["quantity"] . '</td> 
    </tr>'; 
} 
 
$html .= '</table>'; 
 
$pdf->writeHTML($html, true, false, true, false, ""); 
 
$pdf->Output("products.pdf", "D"); 
?>