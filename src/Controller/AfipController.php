<?php

namespace Gonzakpo\AfipBundle\Controller;

use Afip;


/**
 * @author Gonzalo Alonso <gonkpo@gmail.com>
 */
class AfipController
{
    private $project_dir;
    private $afip_parameters;
    private $afip;
    

    public function __construct($afip_parameters, $project_dir)
    {
        $this->project_dir = $project_dir;
        $this->parseParameters($afip_parameters);

        if ($this->afip_parameters) {
            $this->afip = new Afip($this->afip_parameters);
        }
    }
    
    
    

    private function parseParameters($afip_parameters)
    {
        if ($afip_parameters['CUIT'] > 0) {
            $afip_parameters['res_folder'] = $this->project_dir."/".$afip_parameters['res_folder'];
            $afip_parameters['ta_folder'] = $this->project_dir."/".$afip_parameters['ta_folder'];
        } else {
            $afip_parameters = null;
        }

        $this->afip_parameters = $afip_parameters;
    }

    public function createAfip($afip_parameters)
    {
        $this->parseParameters($afip_parameters);

        if ($this->afip_parameters) {
            $this->afip = new Afip($this->afip_parameters);
        }
    }

    public function getWS()
    {
        return $this->afip;
    }
    
    public function getWSFE()
    {
        $facturaE = $this->afip->__get('ElectronicBilling');
        
        return $facturaE;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function setWSFE($data)
    {
        $facturaE = $this->afip->__get('ElectronicBilling');
        $res = $facturaE->CreateVoucher($data);
        
        
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
     public function getDatos($data)
    {
        $datos = $this->afip->__get($data);
        return $datos;        
    }
    
}
