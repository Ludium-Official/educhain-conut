// SPDX-License-Identifier: MIT
pragma solidity ^0.8.26;

import "@openzeppelin/contracts/token/ERC721/ERC721.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract ConutNFT is ERC721, Ownable{
    constructor() ERC721("ConutNFT","CNFT") Ownable(msg.sender) {}

    uint256 private tokenIdCounter; // Token ID 관리
    mapping(uint256 => string) private _tokenURIs; // 토큰 ID별 메타데이터 URI 저장

    function mintNFT(address to, string memory _tokenURI) public onlyOwner {        
        _mint(to, tokenIdCounter); // ERC721의 민트 함수 호출
        _setTokenURI(tokenIdCounter, _tokenURI); // 메타데이터 URI 설정
        tokenIdCounter++;
    }

    function tokenURI(uint256 tokenId) public view override returns (string memory) {
        return _tokenURIs[tokenId];
    }

    function _setTokenURI(uint256 tokenId, string memory _tokenURI) internal onlyOwner{
        _tokenURIs[tokenId] = _tokenURI;
    }
}