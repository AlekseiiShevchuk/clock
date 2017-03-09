<?php

namespace App;


interface HasMovieFileContract
{
    public function getMovieFileName();
    public function setMovieFileName($name);
    public function getId();
}