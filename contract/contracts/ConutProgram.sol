// SPDX-License-Identifier: MIT
pragma solidity ^0.8.26;

import "./ReentrancyGuard.sol";
contract ConutProgram is ReentrancyGuard {
    struct Ranking {
        uint256 rank;
        address walletAddr;
        uint256 reward; // reward는 EDU
    }

    uint256 private programId;
    address private owner;
    bool private status;
    uint256 public totalFunds; // 컨트랙트에 보관된 EDU 총액

    //------- Event -------//
    event InvalidAddress(uint256 indexed rank, uint256 reward);
    event Transfer(address indexed from, address indexed to, uint256 amount);
    event FundsDeposited(address indexed from, uint256 amount);
    event FundsWithdrawn(address indexed to, uint256 amount);

    constructor(uint256 _programId, address _owner) payable{
        programId = _programId;
        totalFunds = msg.value;
        owner=_owner;
        status=false;

        emit FundsDeposited(msg.sender, msg.value);
    }

    modifier onlyOwner() {
        require(msg.sender == owner,"Is not owner");
        _;
    }

    // 보상 배분
    function distributeRewards(Ranking[] memory rankings) external onlyOwner nonReentrant {
        require(status == false, "This Program is Done");
        uint256 totalReward = 0;

        // 전체 보상 금액 계산
        for (uint256 i = 0; i < rankings.length; i++) {
            totalReward += rankings[i].reward;
        }

        // 컨트랙트 잔액이 충분한지 확인
        require(totalFunds >= totalReward, "Insufficient contract balance");

        for (uint256 i = 0; i < rankings.length; i++) {
            if (rankings[i].walletAddr != address(0)) {
                // EDU(네이티브 토큰) 전송
                (bool success, ) = rankings[i].walletAddr.call{value: rankings[i].reward}("");
                require(success, "Failed to send EDU");

                emit Transfer(address(this), rankings[i].walletAddr, rankings[i].reward);
                totalFunds -= rankings[i].reward;
            } else {
                emit InvalidAddress(rankings[i].rank, rankings[i].reward);
            }
        }

        status=true;
    }

    receive() external payable {
        _deposit();
    }

    function deposit() external payable nonReentrant {
        _deposit();
    }

    function _deposit() internal {
        require(msg.value > 0, "Must send some EDU");
        require(status == false, "It is not a period for deposits");
        
        totalFunds += msg.value;

        emit FundsDeposited(msg.sender, msg.value);
    }

    function withdraw() external onlyOwner nonReentrant {
        require(status == true, "Withdrawing is possible after program is closed");

        uint256 balance = address(this).balance;
        (bool success, ) = msg.sender.call{value: balance}("");
        require(success, "Failed to withdraw funds");

        emit FundsWithdrawn(msg.sender, balance);
    }

    function getBalance() external view returns (uint256) {
        return address(this).balance;
    }

    function setStatus() external onlyOwner {
        status=true;
    }
}