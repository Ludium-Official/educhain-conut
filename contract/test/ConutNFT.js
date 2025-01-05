const {ethers} = require("hardhat");

async function deploy() {
    const contract = await ethers.getContractFactory("ConutNFT");
    const conutNFT = await contract.deploy();
  
    console.log(conutNFT);
    console.log("NFT Address: ",conutNFT.target);
}

// deploy().then(()=>process.exit(0).catch((error)=>{
//     console.error(error);
//     process.exit(1);
// }))

// const address = "0x44020b0CB6E252f76b70e47f312aD3D6d6c6A532";
const address = "0xcf76A868a9FB92757655e49F2a9F0AbFfddF4DcC";

async function mintNFT() {
    const contract = await ethers.getContractAt("ConutNFT",address);
    const tx = await contract.mintNFT("0xB05fF66A7Eac8a6e600D83FBdb8c3c1F208FA59e","https://www.coquiz.space/0_educhain/nft/json/14.json");
    console.log(tx);
}

mintNFT().then(()=>process.exit(0).catch((error)=>{
    console.error(error);
    process.exit(1);
}))