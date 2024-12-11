const {ethers} = require("hardhat");

async function deploy() {
    const contract = await ethers.getContractFactory("ConutNFT");
    const conutNFT = await contract.deploy();
  
    console.log(conutNFT);
    console.log("Factory Address: ",conutNFT.target);
}

// deploy().then(()=>process.exit(0).catch((error)=>{
//     console.error(error);
//     process.exit(1);
// }))

const address = "0x44020b0CB6E252f76b70e47f312aD3D6d6c6A532";

async function mintNFT() {
    const contract = await ethers.getContractAt("ConutNFT",address);
    const tx = await contract.mintNFT("0xEA9F48b137AC8a196b8446932bcD53D94eccC673","https://www.coquiz.space/0_educhain/nft/json/1.json");
    console.log(tx);
}

mintNFT().then(()=>process.exit(0).catch((error)=>{
    console.error(error);
    process.exit(1);
}))