<ul>
    
    <li>
        <ul>
            <?php foreach($respuesta as $clave => $valor) : ?>
                <li><b><?php echo $clave ?>:</b> <?php echo $valor ?></li>
            <?php endforeach; ?>
        </ul>
    </li>
</ul>