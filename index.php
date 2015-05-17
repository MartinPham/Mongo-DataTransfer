<?php
ob_implicit_flush();
echo "<pre>";

if(isset($_POST['ok'])){
    $path = dirname(__FILE__)."/db";

    $from_h = $_POST['from_h'];
    $from_u = $_POST['from_u'];
    $from_p = $_POST['from_p'];
    $from_d = $_POST['from_d'];

    if($from_u != "") $from_u = "-u $from_u";
    if($from_p != "") $from_p = "-p $from_p";

    $to_h = $_POST['to_h'];
    $to_u = $_POST['to_u'];
    $to_p = $_POST['to_p'];
    $to_d = $_POST['to_d'];

    if($to_u != "") $to_u = "-u $to_u";
    if($to_p != "") $from_p = "-p $to_p";
    

    echo "Clean" . PHP_EOL;
    $cmd = "/bin/rm -rf $path/$from_d";
    echo $cmd . PHP_EOL;
    exec($cmd, $out, $ret);
    foreach($out as $o){
        echo $o . PHP_EOL;
    }
//    echo $ret . PHP_EOL;
    echo "---------------------------------" . PHP_EOL;
    
    echo "Dump" . PHP_EOL;
    $cmd = "/Users/zzz/Z/DEV/MONGODB/bin/mongodump -h $from_h $from_u $from_p -d $from_d -o $path/";
    echo $cmd . PHP_EOL;
    exec($cmd, $out, $ret);
    foreach($out as $o){
        echo $o . PHP_EOL;
    }
//    echo $ret . PHP_EOL;
    echo "---------------------------------" . PHP_EOL;

    echo "Restore" . PHP_EOL;
    $cmd = "/Users/macbookpro/Z/DEV/MONGODB/bin/mongorestore -h $to_h $to_u $to_p -d $to_d $path/$from_d";
    echo $cmd . PHP_EOL;
    exec($cmd, $out, $ret);
    foreach($out as $o){
        echo $o . PHP_EOL;
    }
//    echo $ret . PHP_EOL;
    echo "---------------------------------" . PHP_EOL;


    echo "Clean" . PHP_EOL;
    $cmd = "/bin/rm -rf $path/$from_d";
    echo $cmd . PHP_EOL;
    //exec($cmd, $out, $ret);
    foreach($out as $o){
        echo $o . PHP_EOL;
    }
//    echo $ret . PHP_EOL;
    echo "---------------------------------" . PHP_EOL;


}
?>
<form method="post">
    <table border="1" style="width:100%" cellpadding="10">
        <tr>
            <td width="50%"><b>FROM</b></td>
            <td width="50%"><b>TO</b></td>
        </tr>
        <tr>
            <td>
                <input style="width:100%" name="from_h" placeholder="Host" value="<?php echo @$_POST['from_h']?>"/><br/>
                <input style="width:100%" name="from_u" placeholder="Username" value="<?php echo @$_POST['from_u']?>"/><br/>
                <input style="width:100%" name="from_p" placeholder="Password" value="<?php echo @$_POST['from_p']?>"/><br/>
                <input style="width:100%" name="from_d" placeholder="Database" value="<?php echo @$_POST['from_d']?>"/><br/>
            </td>
            <td>
                <input style="width:100%" name="to_h" placeholder="Host" value="<?php echo @$_POST['to_h']?>"/><br/>
                <input style="width:100%" name="to_u" placeholder="Username" value="<?php echo @$_POST['to_u']?>"/><br/>
                <input style="width:100%" name="to_p" placeholder="Password" value="<?php echo @$_POST['to_p']?>"/><br/>
                <input style="width:100%" name="to_d" placeholder="Database" value="<?php echo @$_POST['to_d']?>"/><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input style="width:100%" name="ok" type="submit" value="OK"/></td>
        </tr>
    </table>
</form>