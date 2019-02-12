<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para la carga de la plantilla base del sistema y creación de la paginación
 * @version 	: 1.1.0
 * @author 	: LEAS
 * @property    : mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
 * */
class Niveles_acceso {

    private $modulos;
    private $modulosMenu;
    private $html;
    private $ruta_actual;

    public function __construct() {
        $this->html = '';
//        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
//        $this->ruta_actual = '/' . $CI->uri->rsegment(1) . '/' . $CI->uri->rsegment(2);  //Controlador actual o dirección actual
    }

    function getModulos() {
        return $this->modulos;
    }

    function setModulos($modulos) {
        $this->modulos = $modulos;
        $this->setModulosMenu($modulos);
    }

    function getModulosMenu() {
        return $this->modulosMenu;
    }

    private function setModulosMenu($modulos) {
        $tmp = array();
        $tipo_modulo_menu = array('MENU', 'MODAL');
//        pr($this->ruta_actual);
        foreach ($modulos as $value) {
            if (in_array($value['type_module'], $tipo_modulo_menu)) {
                if (is_null($value['module_pather'])) {//Es un padre inicial
                    if (!isset($tmp[$value['cve_module']])) {
                        $tmp[$value['cve_module']] = $value;
                    } else {
                        $tmp[$value['cve_module']] = array_merge($value, $tmp[$value['cve_module']]);
                    }
                } else {
                    if (!isset($tmp[$value['module_pather']])) {
                        $tmp[$value['module_pather']] = array();
                        $tmp[$value['module_pather']]['children'][$value['cve_module']] = [];
                        $tmp[$value['cve_module']] = $value;
                    } else {
                        $tmp[$value['module_pather']]['children'][$value['cve_module']] = [];
                        $tmp[$value['cve_module']] = $value;
                    }
                }
            }
        }
        $this->modulosMenu = $tmp;
    }

    public function getMenu() {
        if (!is_null($this->getModulosMenu())) {
            if (empty($this->html)) {
                $this->html = $this->generaMenu($this->getModulosMenu());
            }
        }
        return $this->html;
    }

    private function generaMenu($modulosMenu) {
//        pr($modulosMenu);
        $aux_pintados = [];
        $grupos_modulos = [];
        $contadorTarget = 1;
        ob_start();
        ?>
        <?php
        foreach ($modulosMenu as $item) {
            $enlace = '#';
            if (isset($item['url'])) {
                if (startsWith($item['url'], 'http://') || startsWith($item['url'], 'https://')) {
                    $enlace = $item['url'];
                } else if (isset($item['children'])) {
                    $enlace = '#';
                } else if (!empty($item['url'])) {
                    $enlace = site_url() . $item['url'];
                } else {
                    $enlace = '#';
                }
            }
            ?>
            <?php
            if (isset($item['children']) && !empty($item['children']) && !isset($aux_pintados[$item['cve_module']])) {//Es un menu con hijos
                $aux_pintados[$item['cve_module']] = $item; //Agrega la clave ya almacenada
                ?>
                <hr class="sidebar-divider">
                <?php
                if (!is_null($item['cve_modulegroup']) && !isset($grupos_modulos[$item['cve_modulegroup']])) {
                    $grupos_modulos[$item['cve_modulegroup']] = '';
                    ?>
                    <div class="sidebar-heading">
                        <?php echo $item['group_module']; ?>
                    </div>
                    <?php
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo $contadorTarget; ?>" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="<?php echo $item['icon']; ?>"></i>
                        <span><?php echo $item['modulename']; ?></span>
                    </a>
                    <div id="collapse<?php echo $contadorTarget; ?>" class="collapse" aria-labelledby="heading<?php echo $contadorTarget; ?>" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php
//                            pr($item['children']);
                            echo $this->generaSubMenu($modulosMenu, $item['children'], $aux_pintados);
                            ?>
                        </div>
                    </div>
                </li>
                <?php
                $contadorTarget++;
            } else {//Es un menu simple 
                if (!isset($aux_pintados[$item['cve_module']])) {//Es un menu con hijos
                    $aux_pintados[$item['cve_module']] = $item; //Agrega la clave ya almacenada
                    ?>
                    <hr class="sidebar-divider">
                    <?php
                    if (!is_null($item['cve_modulegroup']) && !isset($grupos_modulos[$item['cve_modulegroup']])) {
                        $grupos_modulos[$item['cve_modulegroup']] = '';
                        ?>
                        <div class="sidebar-heading">
                            <?php echo $item['group_module']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo $enlace; ?>">
                            <i class="<?php echo $item['icon']; ?>"></i>
                            <span><?php echo $item['modulename']; ?></span></a>
                    </li>
                    <?php
                }
            }
            ?>
        <?php } ?>
        <?php
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

    private function generaSubMenu($modulosMenu, $children, &$auxiliar_pintados) {
        $html = '';
//        pr($children);
        foreach ($children as $key => $value) {
//            pr($modulosMenu[$key]['modulename']);
            $item = $modulosMenu[$key];
            $enlace = '#';
            if (isset($item['url'])) {
                if (startsWith($item['url'], 'http://') || startsWith($item['url'], 'https://')) {
                    $enlace = $item['url'];
                } else if (!empty($item['url'])) {
                    $enlace = site_url() . $item['url'];
                } else {
                    $enlace = '#';
                }
            }
//            pr($enlace);
            $name = $modulosMenu[$key]['modulename'];
            $html .= ' <a class = "collapse-item" href = "' . $enlace . '">' . $name . '</a >' . "\n";
            $auxiliar_pintados[$key] = $item;
        }
//        <a class = "collapse-item" href = "buttons.html"></a >
        return $html;
    }

}
