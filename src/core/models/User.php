<?php

/**
* @Entity @Table(name="user")
*/
Class User {
        
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
                return $this->pseudo;
        }

        public function getPassword() {
                return $this->mdp;
        }

        public function setUsername($p) {
                $this->pseudo = $p;
        }

        public function setPassword($m) {
                $this->mdp = $m;
        }
        
}