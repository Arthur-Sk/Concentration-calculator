<?php

namespace App\Entity;

use App\Forms\CalcForm;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;


class Calc
{

    public $errorMessage;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Base concentrate should be {{ limit }} or more.",
     *     maxMessage = "Base concentrate should be {{ limit }} or less.",
     * )
     */
    protected $BaseConc = 0;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Nicotine (booster) concentrate should be {{ limit }} or more.",
     *     maxMessage = "Nicotine (booster) concentrate should be {{ limit }} or less.",
     * )
     */
    protected $NicConc = 72;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Needed concentrate should be {{ limit }} or more.",
     *     maxMessage = "Needed concentrate should be {{ limit }} or less.",
     * )
     */
    protected $FinalConc = 6;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100000,
     *     minMessage = "Needed volume should be {{ limit }} or more.",
     * )
     */
    protected $FinalVol = 500;
    protected $NicVol;
    protected $BaseVol;

    /**
     * @Assert\IsTrue(message="Nicotine concentrate must be greater than the base liquid concentrate")
     *
     */
    public function isNicConcGreater(){
        return $this->BaseConc <= $this->NicConc;
    }

    /**
     * @Assert\IsTrue(message="Needed concentrate must be greater than the base liquid concentrate")
     *
     */
    public function isFinalConcGreater(){
        return $this->FinalConc >= $this->BaseConc;
    }

    /**
     * @Assert\IsTrue(message="Needed concentrate must be less than the nicotine concentrate")
     *
     */
    public function isFinalConcLess(){
        return $this->FinalConc <= $this->NicConc;
    }

    public function getNicVol()
    {
        return $this->NicVol = ($this->FinalVol*($this->FinalConc-$this->BaseConc))/($this->NicConc-$this->BaseConc);
    }

    public function getBaseVol()
    {
        return $this->BaseVol = ($this->FinalVol*($this->FinalConc-$this->NicConc))/($this->BaseConc-$this->NicConc);
    }

    public function getBaseConc()
    {
        return $this->BaseConc;
    }

    public function setBaseConc($BaseConc)
    {
        $this->BaseConc = $BaseConc;
    }

    public function getNicConc()
    {
        return $this->NicConc;
    }

    public function setNicConc($NicConc)
    {
        $this->NicConc = $NicConc;
    }

    public function getFinalConc()
    {
        return $this->FinalConc;
    }

    public function setFinalConc($FinalConc)
    {
        $this->FinalConc = $FinalConc;
    }

    public function getFinalVol()
    {
        return $this->FinalVol;
    }

    public function setFinalVol($FinalVol)
    {
        $this->FinalVol = $FinalVol;
    }

}