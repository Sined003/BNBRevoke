<?php
require 'vendor/autoload.php';

use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use Web3p\EthereumTx\Transaction;

// BSC RPC endpoint
$rpcUrl = 'https://bsc-dataseed.binance.org/';

// Your wallet info
$privateKey = 'YOUR_PRIVATE_KEY';
$fromAddress = 'YOUR_WALLET_ADDRESS';

// Token contract address (BEP20)
$tokenAddress = 'TOKEN_CONTRACT_ADDRESS';

// Spender contract address to revoke
$spenderAddress = 'SPENDER_CONTRACT_ADDRESS';

// Initialize Web3
$web3 = new Web3($rpcUrl);

// ERC20 ABI fragment for approve function
$erc20Abi = '[{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"type":"function"}]';

// Create contract instance
$contract = new Contract($web3->provider, $erc20Abi);
$contract->at($tokenAddress);

// Prepare approve(0) transaction data
$approveData = $contract->getData('approve', $spenderAddress, '0');

// Get nonce
$web3->eth->getTransactionCount($fromAddress, function ($err, $nonce) use (&$transactionNonce) {
    if ($err !== null) {
        echo 'Error getting nonce: ' . $err->getMessage();
        exit;
    }
    $transactionNonce = $nonce;
});

// Build transaction
$txParams = [
    'nonce' => Utils::toHex($transactionNonce, true),
    'gasPrice' => Utils::toHex(Utils::toWei('5', 'gwei'), true), // Adjust gas price
    'gasLimit' => Utils::toHex(60000, true),
    'to' => $tokenAddress,
    'value' => '0x0',
    'data' => $approveData,
    'chainId' => 56 // BSC mainnet chain id
];

// Sign transaction
$transaction = new Transaction($txParams);
$signedTx = '0x' . $transaction->sign($privateKey);

// Send transaction
$web3->eth->sendRawTransaction($signedTx, function ($err, $txHash) {
    if ($err !== null) {
        echo 'Error sending tx: ' . $err->getMessage();
        return;
    }
    echo "Revoke transaction sent. TxHash: $txHash\n";
});
