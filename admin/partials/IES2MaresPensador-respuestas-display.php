<?php function pensadorMostrarRespuestas($respuestas) { ?>
    <ul class="respuestasAdmin">
    <?php foreach($respuestas as $respuesta) : ?>
        <li>
            <h4><?php echo $respuesta->nombre ?></h4>
            <p class="curso"><?php echo $respuesta->curso ?></p>
            <p class="solucion"><?php echo $respuesta->solucion ?></p>
        </li>
    <?php endforeach; ?>
    </ul>

<?php
}