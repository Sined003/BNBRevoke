
# BNBRevoke

**BNB REVOKE DEFI**

---

## Overview

BNBRevoke is a PHP project designed to help users revoke token approvals on the Binance Smart Chain (BSC). It automates the process of canceling or reducing token allowances granted to decentralized finance (DeFi) smart contracts, improving wallet security by preventing unauthorized token spending.

---

## Features

- Revoke or reduce token allowances on BSC
- Built with PHP for easy integration and automation
- Lightweight and straightforward to use
- MIT licensed open source project

---

## Prerequisites

- PHP 7.4 or higher
- Composer for dependency management
- Access to a Binance Smart Chain RPC endpoint
- Your wallet private key for signing transactions

---

## Installation

1. Clone the repository:

   ```
   git clone https://github.com/Sined003/BNBRevoke.git
   cd BNBRevoke
   ```

2. Install dependencies (if any):

   ```
   composer install
   ```

---

## Usage

Edit the `rbnb.php` file to configure your wallet private key, token contract addresses, and spender addresses you want to revoke.

Run the script from the command line:

```
php rbnb.php
```

The script will connect to the Binance Smart Chain, create and sign transactions to revoke token approvals by setting allowances to zero, and broadcast them to the network.

---

## How It Works

- Connects to the BSC network using a JSON-RPC provider.
- Uses the BEP-20 token contract ABI to interact with the `approve` function.
- Sends transactions to set the allowance of specified spenders to zero.
- Helps protect your tokens from unauthorized spending by DeFi contracts.

---

## Security Notice

- Keep your private keys secure and never share them.
- Use this tool in a secure environment.
- Always verify contract addresses before revoking approvals.
- Be aware of gas fees required for sending transactions on BSC.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

