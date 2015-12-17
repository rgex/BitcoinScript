<?php

namespace BitcoinPHP\BitcoinScript;


class TransactionBuilder
{
    const TX_VERSION = 4;

    private $interpreter;
    private $txInputs;
    private $txOutputs;
    private $prequelTxs;
    private $lockTime;

    public function __construct()
    {

    }

    /**
     * @param Interpreter $Interpreter
     */
    public function setInterpreter($Interpreter)
    {
        $this->interpreter = $Interpreter;
    }

    /**
     * reverse a character chain on a binary level, can be used for little endian -> big endian conversion etc..
     *
     * @param string $string (binary)
     * @return mixed
     */
    public function binaryReverse($string)
    {
        //@todo
        return $string;
    }

    /**
     * Convert a number to a compact Int
     * taken from https://github.com/scintill/php-bitcoin-signature-routines/blob/master/verifymessage.php
     *
     * @param $i
     * @return string
     * @throws \Exception
     */
    public function numToVarIntString($i)
    {
        if ($i < 0xfd) {
            return chr($i);
        } else if ($i <= 0xffff) {
            return pack('Cv', 0xfd, $i);
        } else if ($i <= 0xffffffff) {
            return pack('CV', 0xfe, $i);
        } else {
            throw new \Exception('int too large');
        }
    }

    /**
     * @param $n
     * @return int
     * @throws \Exception
     */
    public function varIntStringToInt($n)
    {
        if (strlen($n) == 1) // 8 bits
            return ord($n);
        elseif (strlen($n) == 2) // 16 bits
            return unpack('v', $n)[1];
        elseif (strlen($n) == 3) // 24 bits
        { // according to http://stackoverflow.com/a/11732142/2652054
            $return = unpack('ca/ab/cc', $n);
            return $return['a'] + ($return['b'] << 8) + ($return['c'] << 16);
        } elseif (strlen($n) == 4) // 32 bits
            return unpack('V', $n)[1];
        else
            throw new \Exception('number too big');
    }

    /**
     * Is required when wanting to test a transaction against another
     *
     * @param string $tx (hexa)
     */
    public function addRawPrequelTx($tx)
    {
        $this->prequelTxs[] = $tx;
    }

    /**
     * The input script will only be added later using addTxInputScript, signInput, signInputs
     *
     * @param string $txHash (hexa)
     * @param integer $outputIndex
     */
    public function addTxInput($txHash, $outputIndex)
    {
        $this->txInputs[] = [
            'txHash' => $txHash,
            'outputIndex' => $outputIndex
        ];
    }

    /**
     * @param integer $amountInSatoshi
     * @param $outputScript
     */
    public function addTxOutput($amountInSatoshi, $outputScript)
    {
        $this->txOutputs[] = [
            'amountInSatoshi' => $amountInSatoshi,
            'outputScript' => $outputScript
        ];
    }

    /**
     * @param string $txHash (hexa)
     * @param integer $outputIndex
     * @param string $inputScript (hexa)
     */
    public function addTxInputScript($txHash, $outputIndex, $inputScript)
    {

    }

    /**
     * @param string $txHash (hexa)
     * @param integer $outputIndex
     * @param string $privateKey (hexa)
     */
    public function signInput($txHash, $outputIndex, $privateKey)
    {

    }

    /**
     * @param string[] $privateKeys
     */
    public function signInputs(array $privateKeys)
    {

    }

    public function buildTxInput()
    {

    }

    public function buildTxOutput()
    {

    }

    public function buildTransaction()
    {

    }

    public function getTransaction()
    {

    }

    public function getTransactionHash()
    {

    }

    public function getHexTransaction()
    {

    }

    public function getRawTransaction()
    {

    }

    /**
     * @param integer $lockTime
     */
    public function setLockTime($lockTime)
    {
        $this->lockTime = $lockTime;
    }
}