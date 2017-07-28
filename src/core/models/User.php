<?php

/**
* @Entity @Table(name="user")
*/
Class User{
        
        /**
        * @Id @Column(type="integer") @GeneratedValue
        * @var int
        */
        private $id;
        
        /**
        * @Column(type="string")
        * @var string
        */
        private $username;
        
        /**
        * @Column(type="string")
        * @var string
        */
        private $password;
        
        
        public function getId() {
                return $this->id;
        }

        public function getUsername() {
                return $this->username;
        }

        public function getPassword() {
                return $this->password;
        }

        public function setUsername($unsername) {
                $this->username = $username;
        }

        public function setPassword($password) {
                $this->password = $password;
        }
        
}