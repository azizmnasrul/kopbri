<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawais';
$this->params['breadcrumbs'][] = $this->title;
//$this->beginBody();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <?php
    $this->registerCssFile('http://www.jeasyui.com/easyui/themes/default/easyui.css');
    $this->registerCssFile('http://www.jeasyui.com/easyui/themes/icon.css');
    $this->registerCssFile('http://www.jeasyui.com/easyui/themes/color.css');
    $this->registerCssFile('http://www.jeasyui.com/easyui/demo/demo.css');
    $this->registerJsFile('http://code.jquery.com/jquery-1.6.min.js');
    $this->registerJsFile('http://www.jeasyui.com/easyui/jquery.easyui.min.js');
    ?>
</head>
<body>
    <h2>DATA PEGAWAI</h2>
    <p>Click the buttons on datagrid toolbar to do crud actions.</p>
    
    <table id="dg" title="My Users" class="easyui-datagrid" style="width:100%;height:75%"
            url="get_users.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="no" width="10">NO</th>
                <th field="nip" width="50">NIP</th>
                <th field="nama" width="50">NAMA</th>
                <th field="jabatan" width="30">JABATAN</th>
                <th field="tlp" width="35">Tlp</th>
                <th field="email" width="100">Email</th>
                <th field="alamat" width="110">Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawai as $data) {?>
            <tr>
                <td><?=$data['ID']?></td>
                <td><?=$data['NIP']?></td>
                <td><?=$data['NAMA']?></td>
                <td><?=$data['JABATAN']?></td>
                <td><?=$data['TLP']?></td>
                <td><?=$data['EMAIL']?></td>
                <td><?=$data['ALAMAT']?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">User Information</div>
        <form id="fm" method="post" novalidate>
            <div class="fitem">
                <label>NO:</label>
                <input name="no" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>NIP:</label>
                <input name="nip" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>NAMA:</label>
                <input name="nama" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>JABATAN:</label>
                <input name="jabatan" class="easyui-textbox" required="true" validType="email">
            </div>
            <div class="fitem">
                <label>TLP:</label>
                <input name="tlp" class="easyui-textbox" required="true" validType="email">
            </div>
            <div class="fitem">
                <label>EMAIL:</label>
                <input name="email" class="easyui-textbox" required="true" validType="email">
            </div>
            <div class="fitem">
                <label>ALAMAT:</label>
                <input name="alamat" class="easyui-textbox" required="true" validType="email">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            
            $('#dlg').dialog();
            $('#fm').form('clear');
            url = '#';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
                $('#fm').form('load',row);
                url = 'update_user.php?id='+row.id;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('destroy_user.php',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
    </style>
</body>
</html>
