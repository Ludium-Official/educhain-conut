const hre = require("hardhat");

async function createFactory() {
  const contract = await hre.ethers.getContractFactory("ConutFactory");
  const conut = await contract.deploy();

  console.log(conut);
  console.log("Factory Address: ",conut.target);
}

// createFactory().then(()=> process.exit(0)).catch((error)=>{
//   console.error(error);
//   process.exit(1);
// });


async function createProgram() {
  const address = "0x048FD5cCFC606504353562F29dB75C81d96379FC"; //Factory address
  const contract = await ethers.getContractAt("ConutFactory",address);

  const tx = await contract.createProgram({value: 2000000000000000});
  console.log(tx);
}

async function getProgram() {
    const address = "0x048FD5cCFC606504353562F29dB75C81d96379FC"; //Factory address
    const contract = await ethers.getContractAt("ConutFactory",address);

    const programs = await contract.getPrograms();
    console.log("Program Id: ",programs[programs.length-1]);
}

// createProgram().then(async()=> {
//   await getProgram();
//   process.exit(0);
// }
//   ).catch((error)=>{
//   console.error(error);
//   process.exit(1);
// });