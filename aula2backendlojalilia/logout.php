<?php
session_start();
session_unset();
$_SESSION = []; //$_SESSION = array() ou assim só que de forma mais antiga abriu a array para certificação (redundância) de apagamento das infos salva na session array
session_destroy();
header('location: ./');
// não se pode ter nenhuma saída antes ou depois do header(location), pois as saída impedem o redirecionamento