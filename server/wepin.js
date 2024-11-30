// 1. 패키지 import
import { WepinLogin } from "@wepin/login-js";

// 2. 초기화
const wepinLogin = new WepinLogin({
  appId: "fabc3e2b39b96fb214dbd3f027ed1726",
  appKey: "ak_live_6LktE7yRpWCwjOWMmQuADeADltfEuGLJfnfNWrjdcoE",
});

const express = require("express");
const app = express();

app.use(express.json());

app.post("/register", async (req, res) => {
  const { email, password } = req.body;

  // 간단한 유효성 검사
  if (!email || !password) {
    return res
      .status(400)
      .json({ success: false, message: "Email and password are required." });
  }

  await wepinLogin.loginWithEmailAndPassword(email, password);

  // 여기에서 데이터베이스 저장 로직 추가 가능
  console.log("User Registered:", { email, password }); // 콘솔에 데이터 출력

  // 응답 전송
  res
    .status(200)
    .json({ success: true, message: "User registered successfully." });
});

app.listen(3005, () => {
  console.log("Node.js server running on port 3005");
});
