const hre = require("hardhat");

async function createFactory() {
  const contract = await hre.ethers.getContractFactory("ConutFactoryTemp");
  const conut = await contract.deploy();

  console.log(conut);
  console.log("Factory Address: ",conut.target);
}

// createFactory().then(()=> process.exit(0)).catch((error)=>{
//   console.error(error);
//   process.exit(1);
// });


async function createProgram() {
  const address = "0xd857d8665C047a35C2949d64c5c6Aa16946418f8"; //Factory address
  const contract = await ethers.getContractAt("ConutFactoryTemp",address);

  const tx = await contract.createProgram({value: 2000000000000000});
  console.log(tx);
}

async function getProgram() {
    const address = "0xd857d8665C047a35C2949d64c5c6Aa16946418f8"; //Factory address
    const contract = await ethers.getContractAt("ConutFactoryTemp",address);

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

getProgram();