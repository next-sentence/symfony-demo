<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\DataFixture;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\User\Model\UserInterface;

class LoadUserData extends DataFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->createUser(
            'admin@example.com',
            'adminpass',
            true,
            ['ROLE_USER', 'ROLE_ADMINISTRATION_ACCESS']
        );

        $user->setName('John Doe');
        $user->setTitle('Admin User');
        $user->setInfo('Other info');


        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool   $enabled
     * @param array  $roles
     * @param string $currency
     *
     * @return User
     */
    protected function createUser($email, $password, $enabled = true, array $roles = ['ROLE_USER'])
    {
        $canonicalizer = $this->get('sylius.canonicalizer');

        /* @var $user UserInterface */
        $user = $this->get('sylius.factory.backend_user')->createNew();
        $user->setUsername($email);
        $user->setEmail($email);
        $user->setUsernameCanonical($canonicalizer->canonicalize($user->getUsername()));
        $user->setEmailCanonical($canonicalizer->canonicalize($user->getEmail()));
        $user->setPlainPassword($password);
        foreach ($roles as $role) {
            $user->addRole($role);
        }
        $user->setEnabled($enabled);

        $this->get('sylius.security.password_updater')->updatePassword($user);

        return $user;
    }

    public function getOrder()
    {
        return 10;
    }


}