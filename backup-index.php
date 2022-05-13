<?php

$url = $_SERVER['REQUEST_URI'];  
header("Refresh: 5; URL=$url");  
//echo "Halaman ini akan direfresh setiap 15 detik</br>";
echo '<font size=15 color=Blue>Penambangan Sinyal Harian INDODAX</font></br></br></br>';

// Create database connection using config file
include_once("conn.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM btc order by id desc");
?>
 
<html>
<head>    
    <title>Pengumpulan data BTC</title>
</head>
 
<body>

 
    <table width='80%' border=1 align=center>
 
    <tr>
        <th>ID</th>
        <th>Sinyal</th> 
        <th>Level</th> 
        <th>Tanggal dan Waktu</th>
        <th>Harga Rp.</th>
        <th>Harga USDT</th> 
        <th>Vol BTC</th> 
        <th>Vol Rp.</th>
        <th>Last Buy</th>
        <th>Last Sell</th>
        <th>Jenis</th>
        
    </tr>
    <?php  
    while($user_data = mysqli_fetch_array($result)) {  

$konter=$user_data['sinyal'];      

echo "<tr>";

$hrgidr=number_format($user_data['hargaidr']);
$hrgusdt=number_format($user_data['hargausdt']);
$vidr=number_format($user_data['volidr'],8,",",".");
$vusdt=number_format($user_data['volusdt']);
$lbuy=number_format($user_data['lastbuy']);
$lsell=number_format($user_data['lastsell']);

if($konter>=120)
{
echo "<td align=center bgcolor=#FF0000>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#FF0000>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#FF0000>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#FF0000>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#FF0000>".$hrgidr."</td>";
echo "<td align=center bgcolor=#FF0000>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#FF0000>".$vidr."</td>";
echo "<td align=center bgcolor=#FF0000>".$vusdt."</td>";
echo "<td align=center bgcolor=#FF0000>".$lbuy."</td>";
echo "<td align=center bgcolor=#FF0000>".$lsell."</td>";
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=111)
{
echo "<td align=center bgcolor=#FF4500>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#FF4500>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#FF4500>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#FF4500>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#FF4500>".$hrgidr."</td>";
echo "<td align=center bgcolor=#FF4500>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#FF4500>".$vidr."</td>";
echo "<td align=center bgcolor=#FF4500>".$vusdt."</td>";
echo "<td align=center bgcolor=#FF4500>".$lbuy."</td>";
echo "<td align=center bgcolor=#FF4500>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=101)
{
echo "<td align=center bgcolor=#FFA500>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#FFA500>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#FFA500>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#FFA500>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#FFA500>".$hrgidr."</td>";
echo "<td align=center bgcolor=#FFA500>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#FFA500>".$vidr."</td>";
echo "<td align=center bgcolor=#FFA500>".$vusdt."</td>";
echo "<td align=center bgcolor=#FFA500>".$lbuy."</td>";
echo "<td align=center bgcolor=#FFA500>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
} elseif($konter>=91) 
{
echo "<td align=center bgcolor=#E52A2A>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#E52A2A>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#E52A2A>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#E52A2A>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#E52A2A>".$hrgidr."</td>";
echo "<td align=center bgcolor=#E52A2A>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#E52A2A>".$vidr."</td>";
echo "<td align=center bgcolor=#E52A2A>".$vusdt."</td>";
echo "<td align=center bgcolor=#E52A2A>".$lbuy."</td>";
echo "<td align=center bgcolor=#E52A2A>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=81)
{
echo "<td align=center bgcolor=#F20082>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#F20082>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#F20082>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#F20082>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#F20082>".$hrgidr."</td>";
echo "<td align=center bgcolor=#F20082>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#F20082>".$vidr."</td>";
echo "<td align=center bgcolor=#F20082>".$vusdt."</td>";
echo "<td align=center bgcolor=#F20082>".$lbuy."</td>";
echo "<td align=center bgcolor=#F20082>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=71)
{
echo "<td align=center bgcolor=#DC5C5C>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$hrgidr."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$vidr."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$vusdt."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$lbuy."</td>";
echo "<td align=center bgcolor=#DC5C5C>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
} elseif($konter>=61) {
echo "<td align=center bgcolor=#FF69B4>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#FF69B4>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#FF69B4>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#FF69B4>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#FF69B4>".$hrgidr."</td>";
echo "<td align=center bgcolor=#FF69B4>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#FF69B4>".$vidr."</td>";
echo "<td align=center bgcolor=#FF69B4>".$vusdt."</td>";
echo "<td align=center bgcolor=#FF69B4>".$lbuy."</td>";
echo "<td align=center bgcolor=#FF69B4>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}elseif($konter>=51) 
{
echo "<td align=center bgcolor=#F08080>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#F08080>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#F08080>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#F08080>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#F08080>".$hrgidr."</td>";
echo "<td align=center bgcolor=#F08080>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#F08080>".$vidr."</td>";
echo "<td align=center bgcolor=#F08080>".$vusdt."</td>";
echo "<td align=center bgcolor=#F08080>".$lbuy."</td>";
echo "<td align=center bgcolor=#F08080>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=41)
{
echo "<td align=center bgcolor=#FFA07A>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#FFA07A>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#FFA07A>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#FFA07A>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#FFA07A>".$hrgidr."</td>";
echo "<td align=center bgcolor=#FFA07A>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#FFA07A>".$vidr."</td>";
echo "<td align=center bgcolor=#FFA07A>".$vusdt."</td>";
echo "<td align=center bgcolor=#FFA07A>".$lbuy."</td>";
echo "<td align=center bgcolor=#FFA07A>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=31)
{
echo "<td align=center bgcolor=#9370D8>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#9370D8>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#9370D8>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#9370D8>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#9370D8>".$hrgidr."</td>";
echo "<td align=center bgcolor=#9370D8>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#9370D8>".$vidr."</td>";
echo "<td align=center bgcolor=#9370D8>".$vusdt."</td>";
echo "<td align=center bgcolor=#9370D8>".$lbuy."</td>";
echo "<td align=center bgcolor=#9370D8>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
} elseif($konter>=21) 
{
echo "<td align=center bgcolor=#BA55D3>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#BA55D3>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#BA55D3>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#BA55D3>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#BA55D3>".$hrgidr."</td>";
echo "<td align=center bgcolor=#BA55D3>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#BA55D3>".$vidr."</td>";
echo "<td align=center bgcolor=#BA55D3>".$vusdt."</td>";
echo "<td align=center bgcolor=#BA55D3>".$lbuy."</td>";
echo "<td align=center bgcolor=#BA55D3>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
} elseif($konter>=11) 
{
echo "<td align=center bgcolor=#66CDAA>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#66CDAA>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#66CDAA>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#66CDAA>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#66CDAA>".$hrgidr."</td>";
echo "<td align=center bgcolor=#66CDAA>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#66CDAA>".$vidr."</td>";
echo "<td align=center bgcolor=#66CDAA>".$vusdt."</td>";
echo "<td align=center bgcolor=#66CDAA>".$lbuy."</td>";
echo "<td align=center bgcolor=#66CDAA>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

elseif($konter>=1)
{
echo "<td align=center bgcolor=#32CD32>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#32CD32>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#32CD32>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#32CD32>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#32CD32>".$hrgidr."</td>";
echo "<td align=center bgcolor=#32CD32>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#32CD32>".$vidr."</td>";
echo "<td align=center bgcolor=#32CD32>".$vusdt."</td>";
echo "<td align=center bgcolor=#32CD32>".$lbuy."</td>";
echo "<td align=center bgcolor=#32CD32>".$lsell."</td>";    
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

else
{
echo "<td align=center bgcolor=#00FF00>".$user_data['id']."</td>";
echo "<td align=center bgcolor=#00FF00>".$user_data['sinyal']."</td>";
echo "<td align=center bgcolor=#00FF00>".$user_data['level']."</td>";
echo "<td align=center bgcolor=#00FF00>".$user_data['tanggal']."</td>";
echo "<td align=center bgcolor=#00FF00>".$hrgidr."</td>";
echo "<td align=center bgcolor=#00FF00>".$hrgusdt."</td>";
echo "<td align=center bgcolor=#00FF00>".$vidr."</td>";
echo "<td align=center bgcolor=#00FF00>".$vusdt."</td>";
echo "<td align=center bgcolor=#00FF00>".$lbuy."</td>";
echo "<td align=center bgcolor=#00FF00>".$lsell."</td>";
if ($user_data['jenis']=='crash'){
echo "<td align=center bgcolor=red>".$user_data['jenis']."</td>";}
elseif ($user_data['jenis']=='moon'){
echo "<td align=center bgcolor=green>".$user_data['jenis']."</td>";}
}  

        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>