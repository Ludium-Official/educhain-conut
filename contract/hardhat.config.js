require("@nomicfoundation/hardhat-toolbox");

module.exports = {
  solidity: "0.8.26",
  networks: {
    edu: {
      url: "https://rpc.open-campus-codex.gelato.digital",
      accounts: ["53d3069385dd1bed7d47876e410b9a84861502fe99f060ea25a732ee10c58d8c"]
    }
  },
  etherscan: {
    apiKey: {
      'edu-chain-testnet': 'empty'
    },
    customChains: [
      {
        network: "edu-chain-testnet",
        chainId: 656476,
        urls: {
          apiURL: "https://edu-chain-testnet.blockscout.com/api",
          browserURL: "https://edu-chain-testnet.blockscout.com"
        }
      }
    ]
  }
};