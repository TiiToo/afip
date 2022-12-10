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
    
    public function getWSA7()
    {
        $facturaE = $this->afip->__get('RegisterScopeSeven');
        
        return $facturaE;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function checkHomonimia($data)
    {
        $wsa7 = $this->afip->__get('RegisterScopeSeven');
        $res = $wsa7->checkHomonimia($data);
        
        
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function getValidatePersonaWSA7($data)
    {
        $wsa7 = $this->afip->__get('RegisterScopeSeven');
        $res = $wsa7->validatePersona($data);
        
        
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function createPersonaWSA7($data)
    {
        $wsa7 = $this->afip->__get('RegisterScopeSeven');
        $res = $wsa7->createPersona($data);
        
        
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function getPersonaWSA7($data)
    {
        $wsa7 = $this->afip->__get('RegisterScopeSeven');
        $res = $wsa7->getPersona($data);
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function getWSA7Status()
    {
        $facturaE = $this->afip->__get('RegisterScopeSeven');
        $res = $facturaE->GetServerStatus();
        
        
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    
    public function getPersonaWSA9($data)
    {
        $wsa9 = $this->afip->__get('RegisterScopeNine');
        $res = $wsa9->getPersona($data);
        return $res;
        //$facturaE = json_decode(json_encode($facturaE->GetVoucherTypes()), true);
        
    }
    
    public function getWSA100($data)
    {
        $wsa100 = $this->afip->__get('RegisterScopeOneHundred');
        
        
        $res = $wsa100->getParameterCollectionByName($data);
        return $res;
        
    }
   
    
     public function getDatos($data)
    {
        $datos = $this->afip->__get($data);
        return $datos;        
    }
    
}
