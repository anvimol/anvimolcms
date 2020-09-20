<?php 

// Key Value From Json
function kvfj($json, $key) {
    if ($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function getModulesArray() {
    $a = [
        '0' => 'Productos',
        '1' => 'Blog'
    ];

    return $a;
}

function getRoleUserArray($mode, $id) {
    $roles = ['0' => 'Usuario', '1' => 'Administrador'];
    if (!is_null($mode)) {
        return $roles;
    }
    else {
        return $roles[$id];
    }
}