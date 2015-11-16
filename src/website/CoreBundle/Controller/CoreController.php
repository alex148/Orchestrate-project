<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 10/11/2015
 * Time: 17:17
 */

namespace website\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use website\CoreBundle\Model\User;
use website\CoreBundle\Model\Location;

class CoreController extends Controller{


    public function indexAction()
    {
        $orchestrate = $this->get("orchestrate.service");
        $user = new User();
       // $user->setName('Eudes');
       // $key = $orchestrate->Post("User",$user);
        $orchestrate->Put(User::$collection,$key,$user);
        //$result = $orchestrate->Get(User::$collection,'0db2b2d70140ae09');
        $user = User::arrayToUsers($result);
        $result2 = $orchestrate->Search(User::$collection,'value.first_name:toto',3,3,'value.first_name:asc');
        return $this->render('websiteCoreBundle::index.html.twig', array(
            'test' =>json_encode($user)
        ));
    }
}