const {ethers} = require("hardhat");

const data = {
    "rankings": [
      {"rank": 1, "walletAddr" : "0x49f44752140f1a32493EB905d0A6Ee82677eE373", "reward": 500000000000000},
      {"rank": 2, "walletAddr" : "0xADA560D9D221a9f6E2B8721f72B8a863CB1fB33B", "reward": 300000000000000},
      {"rank": 3, "walletAddr" : "0xAed3562d9C4c2D44ecc5Bb78aE906874DCcF9A4C", "reward": 200000000000000},
    ]
}

// console.log(data.rankings);
const address = "0x7B6c9cF75fCCBB99149c8De04dBa42b0bFa6A649";


async function distributeRewards() {
    const contract = await ethers.getContractAt("ConutProgram",address);
    const tx = await contract.distributeRewards(data.rankings);
    console.log(tx);
}

async function withdraw() {    
    const contract = await ethers.getContractAt("ConutProgram",address);
    const tx = await contract.withdraw();
    console.log(tx);
}

async function deposit() {
    const contract = await ethers.getContractAt("ConutProgram",address);
    const tx = await contract.deposit({value: 2000000000000000});
    console.log(tx);
}

// withdraw().then(()=> process.exit(0)).catch((error)=>{
//     console.error(error);
//     process.exit(1);
// });
distributeRewards();