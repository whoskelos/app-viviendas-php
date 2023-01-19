<HTML LANG="es">

<HEAD>
    <TITLE>Solicitud de vivenda</TITLE>
    <LINK REL="stylesheet" TYPE="text/css" HREF="">
</HEAD>

<BODY>


    <H1>Inserción de vivienda</H1>

    <P>Introduzca los datos de la vivienda:</P>

    <FORM CLASS="borde" ACTION="insertar-vivienda.php" METHOD="POST" ENCTYPE="multipart/form-data">

        <P><LABEL>Tipo de vivienda:</LABEL>
            <SELECT NAME="tipo">

                <OPTION>Piso
                <OPTION>Adosado
                <OPTION>Chalet
                <OPTION>Casa

            </SELECT>
        </P>

        <P><LABEL>Zona:</LABEL>
            <SELECT NAME="zona">

                <OPTION>Centro
                <OPTION>Nervión
                <OPTION>Triana
                <OPTION>Aljarafe
                <OPTION>Macarena

            </SELECT>
        </P>

        <P><LABEL>Dirección:</LABEL>
            <INPUT TYPE="TEXT" NAME="direccion">
            <?php
            if (isset($_GET['err']) && $_GET['err'] == "dir") {
                echo "<p style='color:red;'>Formato direccion no valido</p>";
            }
            ?>
        </P>

        <P><LABEL>Número de dormitorios:</LABEL>

            <INPUT TYPE='radio' NAME='ndormitorios' VALUE='1'>1
            <INPUT TYPE='radio' NAME='ndormitorios' VALUE='2'>2
            <INPUT TYPE='radio' NAME='ndormitorios' VALUE='3' CHECKED>3
            <INPUT TYPE='radio' NAME='ndormitorios' VALUE='4'>4
            <INPUT TYPE='radio' NAME='ndormitorios' VALUE='5'>5

        </P>

        <P><LABEL>Precio:</LABEL>
            <INPUT TYPE="TEXT" NAME="precio"> &euro;
            <?php
            if (isset($_GET['err']) && $_GET['err'] == "pre") {
                echo "<p style='color:red;'>Formato precio no valido</p>";
            }
            ?>
        </P>

        <P><LABEL>Tamaño:</LABEL>
            <INPUT TYPE="TEXT" NAME="tamano"> metros cuadrados
            <?php
            if (isset($_GET['err']) && $_GET['err'] == "tam") {
                echo "<p style='color:red;'>Formato tamano no valido</p>";
            }
            ?>
        </P>

        <P><LABEL>Extras (marque los que procedan):</LABEL>

            <INPUT TYPE='checkbox' NAME='extras[]' VALUE='Piscina'>Piscina
            <INPUT TYPE='checkbox' NAME='extras[]' VALUE='Jardín'>Jardín
            <INPUT TYPE='checkbox' NAME='extras[]' VALUE='Garaje'>Garaje
            <INPUT TYPE='checkbox' NAME='extras[]' VALUE='Sauna'>Sauna

        </P>

        <P><LABEL>Foto:</LABEL>

            <INPUT TYPE="FILE" NAME="foto" value='examinar'>
            <input type="hidden" name="MAX_FILE_SIZE" value="102400">

        </P>

        <P><LABEL>Observaciones:</LABEL>
            <TEXTAREA NAME="observaciones" COLS="50" ROWS="5"></TEXTAREA>
        </P>

        <P><INPUT TYPE="submit" NAME="insertar" VALUE="Insertar vivienda"></P>
        <p><a href="index.php">Volver</a></p>

    </FORM>


</BODY>

</HTML>