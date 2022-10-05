<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formularioInicio</title>

</head>
<body>
    <form method="post" action="validar.php">
        <table>
            <tr>
                <td>Cargo:</td>
                <td><select name="cargo" id="color">
                    <?php
                        try{
                            $base = new PDO('mysql:host=localhost; dbname=rol', 'root', '');
                            $base -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    
                            $base -> exec("SET CHARACTER SET utf8");
                            $sql = "select * from cargo";
                            $resultado = $base -> prepare($sql);
                            $resultado -> execute(array());
                            
                            while($registro = $resultado -> fetch(PDO::FETCH_ASSOC)){
                                echo "<option value=".$registro['id'].">".$registro['descripcion']."</option>";
                            }
                            $resultado -> closeCursor();
                        } CATCH(Exception $e){
                            die('Error: ' . $e -> GetMessage());
                        } 
                    ?>
                </select></td>
            </tr>
            <tr>
                <td>Usuario:</td>
                <td><input name="usuario" type="text" >  </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input name="pasword" type="password"></td>
            </tr>
            <tr>
                <td colspan="2"><input name="borrar" type="reset" value="LIMPIAR"> <input value="ENTRAR" name="enviar" type="submit"> </td>
            </tr>
        </table>
    </form>
</body>
</html>