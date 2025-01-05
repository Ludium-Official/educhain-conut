// SPDX-License-Identifier: MIT
pragma solidity ^0.8.26;

import "./ConutProgram.sol";

contract ConutFactoryTemp {
    address[] private programs;
    uint256 private programId;
    uint256 public lastEndTime;

    event ProgramCreated(address programAddr, uint256 programId);

    // modifier onlyOncePerWeek() {
    //     require(lastEndTime < block.timestamp, "Program creation is restricted during the season");
    //     _;
    // }

    constructor() {
        //배포 시점을 기준으로 가장 가까운 월요일 00:00 UTC로 설정
        lastEndTime = block.timestamp - (block.timestamp % 1 weeks) + 1 days;
    }

    function createProgram() external payable returns (address) {
        require(msg.value > 0, "EDU must be provided to fund the program");

        // ConutProgram 컨트랙트를 생성하며, 일정량의 EDU를 전송
        ConutProgram program = (new ConutProgram){value: msg.value}(programId,msg.sender);
        programs.push(address(program));

        emit ProgramCreated(address(program), programId);

        programId++;
        lastEndTime += (7 days - 2 hours);
        return address(program);
    }

    // 생성된 모든 프로그램 주소 반환
    function getPrograms() external view returns (address[] memory) {
        return programs;
    }
}