<?php

function calcMissing($readings) {
    $numbers=[];
    $missingNumbers=[];
    foreach($readings as $reading)
    {
        $number=getData($reading);
        array_push($numbers, $number);
    }
    $lenght=count($numbers);
    for($i=0; $i<$lenght; $i++)
    {
        $numberBefore=0;
        $numberAfter=0;
        while ($numberBefore==0)
        {
            $numberBefore=getNumberBefore($numbers, $lenght, $i, $numberBefore);
        }
        while ($numberAfter==0)
        {
            $numberAfter=getNumberAfter($numbers, $lenght, $i, $numberAfter);
        }
        
        if ($numbers[$i]==0)
        {
            $expectedNumber=$numbers[$i];
            $y1=$numberBefore;
            $y2=$numberAfter;
            $expectedNumber=($y1+((0.5)*($y2-$y1)));
            array_push($missingNumbers,$expectedNumber);
        }
    }
    foreach($missingNumbers as $number)
    {
        echo(floatval($number).PHP_EOL);
    }
}

function getData($reading)
{
    $i=0;
    $numberArray=[];
    $readingArray=str_split($reading);
    $lenght=(count($readingArray)-1);
    while($i!=1)
    {
        $letter=$readingArray[$lenght];
        if($letter!="\t")
        {
            array_unshift($numberArray, $letter);
        }
        if($letter=="\t")
        {
            $i++;
        }
        $lenght--;
    }
    $number=floatval(implode($numberArray));
    return $number;
}

function getNumberAfter($numbers, $lenght, $i, $numberAfter)
{
    if (isset($numbers[$i+1])==True && $numbers[$i+1]!=0)
    {
        $numberAfter=$numbers[$i+1];
    }
    if (isset($numbers[$i+1])==True && $numbers[$i+1]==0 && isset($numbers[$i+2])==True && $numbers[$i+2]!=0 )
    {
        $numberAfter=$numbers[$i+2];
    }
    if (isset($numbers[$i+1])==True && $numbers[$i+1]==0 && isset($numbers[$i+2])==True && $numbers[$i+2]==0 && isset($numbers[$i+3])==True && $numbers[$i+3]!=0)
    {
        $numberAfter=$numbers[$i+3];
    }
    if ($numberAfter==0)
    {
        $random = rand(0,$lenght);
        $numberAfter=$numbers[$random];
    }
    return $numberAfter;
}

function getNumberBefore($numbers, $lenght, $i, $numberBefore)
{
    if (isset($numbers[$i-1])==True && $numbers[$i-1]!=0)
    {
        $numberBefore=$numbers[$i-1];
    }
    if (isset($numbers[$i-1])==True && $numbers[$i-1]==0 && isset($numbers[$i-2])==True && $numbers[$i-2]!=0 )
    {
        $numberBefore=$numbers[$i-2];
    }
    if (isset($numbers[$i-1])==True && $numbers[$i-1]==0 && isset($numbers[$i-2])==True && $numbers[$i-2]==0 && isset($numbers[$i-3])==True && $numbers[$i-3]!=0 )
    {
        $numberBefore=$numbers[$i-3];
    }
    if ($numberBefore==0)
    {
        $random = rand(0,$lenght);
        $numberBefore=$numbers[$random];
    }
    return $numberBefore;
}

?>