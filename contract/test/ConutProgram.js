const {ethers} = require("hardhat");

const data = {
    "rankings": [
      {"rank": 1, "walletAddr" : "0xEA9F48b137AC8a196b8446932bcD53D94eccC673", "reward": 500000000000000},
      {"rank": 2, "walletAddr" : "0x8cCd14c4161CB63B8C333096e36A1Ff7027F13F4", "reward": 300000000000000},
      {"rank": 3, "walletAddr" : "0x769133F76F6C5CB627b24361657e032726a2F891", "reward": 200000000000000},
    ]
}

// console.log(data.rankings);
const address = "0xed0bF5597B76B4Cb2b0E718c673CBd58D9ceF667";


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