<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 10/11/2015
 * Time: 17:17
 */

namespace website\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use website\CoreBundle\Model\Address;
use website\CoreBundle\Model\User;
use website\CoreBundle\Model\Location;

class CoreController extends Controller{


    public function indexAction()
    {
        $orchestrate = $this->get("orchestrate.service");
        $userService = $this->get("user.service");
        //creation addresse
       /* $address = new Address();
        $address->setLine1("12 Rue des chats");
        $address->setLine2(null);
        $address->setZipCode("69100");
        $address->setName("Home");
        $address->setCity("Lyon");*/
        //creation user
        //$user = new User();
        //$user->setAddress($address);
        //$userService->createUser($user);
        //$key = $orchestrate->Post("User",$user);
       // $user->setKey($key);
        $user = $userService->getUser('0e1f0d9fbb40dd77');
       // $friend = $userService->getUser('0e1f10a39140dd78');
       // $userService->addFriend($user,$friend);
       $user->setBirthDate('25-02-1993');
       // $userService->updateUser($user);
        //$userService->addFriend($user,'0e0d1b492d40979d');
        //$orchestrate->Put(User::$collection,$key,$user);
        //$result = $orchestrate->Get(User::$collection,'0db2b2d70140ae09');
        //$user = User::kvObjectToUser($result);
        //$result2 = $orchestrate->Search(User::$collection,'value.first_name:toto',3,3,'value.first_name:asc');
        return $this->render('websiteCoreBundle::index.html.twig', array(
            'test' =>json_encode($user)
        ));
    }
}