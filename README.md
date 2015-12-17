BitcoinScript
=============

Code is not functional yet

Objectives
==============

Create a transaction should look somehow like this:
```php
$transactionBuilder->addTxInput($outputTransactionHash,
                               $outputIndex
                               )
                   ->addTxOutput($amountInSatoshi,
                              $scriptBuilder->addData('HELLO') //sig Script
                                            ->addOpCode($OpCodes::OP_DUP)
                                            ->addData('HELLO2')
                                            ->addOpCode($OpCodes::OP_EQUAL)
                                            ->getRawScript()
                              )
                   )
                   ->sign....
                   ->getRawTransaction();
```
