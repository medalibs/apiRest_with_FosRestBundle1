<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\User;


/**
 * Description of UsersController
 *
 * @author mas
 */
class UsersController extends Controller {
    
    public function getUsersAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $users = $repository->findAll();
        
        return $users;
        
    }
    
    public function getUserAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = $repository->find($id);
        
        return $user;
        
    }
    
    public function putUsersAction()
    {
        
    }
    
    public function postUsersAction(Request $request)
    {
        
        
        $jsonObject = json_decode($request->getContent(), true);
        
        
        
        $user = new User();
        $user->setEmail($jsonObject['email']);
        $user->setFirstName($jsonObject['firstname']);
        $user->setLastName($jsonObject['lastname']);
        $user->setEnabled($jsonObject['enabled']);
        
        $createdAt = new \DateTime();
        $createdAt->format("Y-m-d H:i:s");
        
        $user->setCreatedAt($createdAt);
        
        
        $em = $this->getDoctrine()->getManager();

        
        $em->persist($user);

        
        $em->flush();

        return array('id' => $user->getId());
        
        
        
    }
    
    public function getUserVerifAction($id)
    {
        
    }
    
}
