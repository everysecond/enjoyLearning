<template>
	<view class="content">
		<view class="bg_box">
			  <view :class="{myVideo:true,nobg:played,endbg:playEnd}">
				  <audio id="autoPlay"
						autoplay
					/>
					<!-- web-view src用在线地址 -->
				  <web-view :webview-styles="webviewStyles" :src="webviewSrc"></web-view>
			  </view>
		     <view id="audeo_box">
		     	<!-- <audio id="myAudio" style="text-align: left" src="../../static/plane_bgm.wav" autoplay controls></audio> -->
		     </view>
			 
			 <view id="audeo_box2"> </view>
			
			 <!-- <audio src=""></audio> -->
			<image class="fle" src="../../static/logo.png" :class="{addAnimation:addAnimation,display:display}" @click="goNext()"
			 mode=""></image> 
		</view>
	</view>
</template>

<script>
	import JSMpeg from '../../static/jsmpeg.min';
	import global_request from '../../global-request/index.js'

	export default {
		data() {
			return {
				title: 'Hello',
				display: true,
				played:false,
				addAnimation: false,
				videoContext: '',
				playEnd:false,
				webviewSrc:'../../static/video.html?v='+Date.now(),
				webviewStyles: {
					progress: {
						color: '#ccc'
					}
				}
			}
		},
		onReady: function(res) {
			
			this._playIframe();
			// this._playAudio('../../static/index_mp4.mp3');
			this._playAudio_mq();
			this.getJSSDKdata();
			
		},
		onShow() {
			
			
		},
		methods: {
			ended() {
				// this.display = false;
			},
			play() {
				// document.getElementsByClassName('uni-video-bar-full')[0].innerHTML = ""
			},
			_playIframe(){
				var iframe = document.querySelector('iframe');
				console.log('iframe playMedia',iframe);
				console.log('iframe playMedia',iframe.contentWindow);
				iframe.onload = ()=>{
					var canvas = iframe.contentWindow.document.getElementById("canvas");
					console.log(canvas)
					iframe.contentWindow.player = 
						new JSMpeg.Player('../../static/v15.6.33Video.mp4-1500k.ts?v='+Date.now(), {
						// iframe.contentWindow.player = new JSMpeg.Player('./static/800k1749904.ts', {
						canvas: canvas,
						audio: false,
						chunkSize: 512 * 1024,
						fileSize:3951760,
						loop: false,
						autoplay: true,
						// poster:'http://ydjc-education.oss-cn-hangzhou.aliyuncs.com/upload/file/20200329/2f164e8a3bd8227645c54be3e77b9dc070abd3fd.mp4?x-oss-process=video/snapshot,t_3000,m_fast',
						onPlay:(play)=>{
							console.log('onPlay', play)
						},
						onEnded:(player)=>{
							console.log('onEnded', player)
							// this.display = false;
							this.playEnd=true;
							player.stop();
							player.destroy();
							var audio = document.querySelector('audio');
							console.log('audio playMedia', audio);
							if (audio && !audio.paused){
								audio.pause();
							}
							
							setTimeout(() => {
								uni.navigateTo({
									url: '../second/second'
								})
							}, 200)
						}
					});
					setTimeout(()=>{
						this.played=true;
					},1000);
				};
			},
			// 老版本  ios手机 没有声音
			_playAudio(url){
				var audio = document.querySelector('audio');
				console.log('audio playMedia', audio);
				if (audio){
					audio.autoplay = true;
					// audio.volume=0.5;
					audio.loop =true;
					audio.src = url;
					audio.style.display='block';
					// var audio = document.getElementById(id);
					
					// audio.play();
					
					document.addEventListener("WeixinJSBridgeReady", function () {
					audio.play();
					
					}, false);
					
					audio.play().catch(() =>
					{
						setTimeout(() =>
						{
							audio.play().catch(() =>
							{
								audio.setAttribute('controls', 'controls');
								audio.addEventListener('playing', () =>
								{
									audio.removeAttribute('controls');
								});
							});
						}, 300);
					});
				}
			},
			_playAudio_mq(){
				var audeo_box = document.getElementById('audeo_box2');
				var audioDom = document.createElement('view')
				audeo_box.innerHTML = '';
				audioDom.innerHTML =
					`<audio id="success_music" style="text-align: left;"   currentTime='0.02' volume='1' 
					 autoplay src="../../static/index_mp4.mp3"></audio>`;
				
				audeo_box.appendChild(audioDom);
				var audio_success = document.getElementById('success_music');
				audio_success.play();
				document.addEventListener("WeixinJSBridgeReady", function () {
					audio_success.play();
				}, false);
			},
			goNext() {
				this.addAnimation = true;
				var audeo_box = document.getElementById('audeo_box');
				var audioDom = document.createElement('view')
				audeo_box.innerHTML=''; 
				audioDom.innerHTML = `<audio id='audioBox' style="text-align: left" volume='1' 
						currentTime='0.02'
					 autoplay='true' src="../../static/plane_bgm.wav"></audio>`;
				audeo_box.appendChild(audioDom)
			
				setTimeout(() => {
					uni.navigateTo({
						url: '../second/second'
					})
				}, 1500)
			},
			// 获取微信SDK 信息  连接sdk
			getJSSDKdata(){
				console.log(location.href)
				var _href=location.href.split('#')[0]
				console.log(_href)
				// alert(_href)
				global_request({
					url: '/wxshare-data',
					data:{
						url:_href
					},
					method: "get"
				}).then((data) => {
					console.log(data)
					var wx = require('jweixin-module')
					var wxShareConfig ,wxShareMsgConfig,wxshareQQConfig,wxshareZoneConfig;
					wxShareConfig = {
					    'title' : '咫尺朝阳，心存梦想——筑梦安徽中医药高考',
					    'link'  : 'http://zyh5.xjyztc.com',
					    'imgUrl': 'http://zyh5.xjyztc.com/img.jpg',
					    success : function(){
							console.log(123)
					    }
					};
					wxShareMsgConfig = {
					    'title' : '咫尺朝阳，心存梦想——筑梦安徽中医药高考',
					    'link'  : 'http://zyh5.xjyztc.com',
					    'imgUrl': 'http://zyh5.xjyztc.com/img.jpg',
					    'desc'  : '@2020高考生，安徽省技能型高水平大学建设单位了解下',
					    success : function(){
					    }
					};
					   wxshareZoneConfig = wxshareQQConfig =wxShareMsgConfig;
					wx.config({
						debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
						appId: data.data.appid, // 必填，公众号的唯一标识
						timestamp: data.data.timestamp, // 必填，生成签名的时间戳
						nonceStr: data.data.nonceStr, // 必填，生成签名的随机串
						signature: data.data.signature, // 必填，签名
						jsApiList:['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone'] // 必填，需要使用的JS接口列表
					});
					wx.ready(function() {
						
						// 自定义“分享给朋友”及“分享到QQ”按钮的分享内容（1.4.0）
						// wx.updateAppMessageShareData({
						// 	title: '132', // 分享标题
						// 	desc: '465', // 分享描述
						// 	link: 'http://zyh5.xjyztc.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
						// 	imgUrl: 'https://edu.ydjclive.com/uploads/2020-03-245e79c9a43b5c6.jpg', // 分享图标
						// 	success: function() {
						// 		// 设置成功
						// 		console.log(1132)
						// 	}
						// })
						// 自定义“分享到朋友圈”及“分享到QQ空间”按钮的分享内容（1.4.0）
						// wx.updateTimelineShareData({
						// 	title: '132', // 分享标题
						// 	link: 'http://zyh5.xjyztc.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
						// 	imgUrl: 'https://edu.ydjclive.com/uploads/2020-03-245e79c9a43b5c6.jpg', // 分享图标
						// 	success: function() {
						// 		// 设置成功
						// 	}
						// })
						
						if(typeof(wxShareConfig)=='object'){
						    wx.onMenuShareTimeline(wxShareConfig);
						}
						if(typeof(wxShareMsgConfig)=='object'){
						    wx.onMenuShareAppMessage(wxShareMsgConfig);
						}
						if(typeof(wxshareQQConfig)=='object'){
						    wx.onMenuShareQQ(wxshareQQConfig);
						}
						if(typeof(wxshareZoneConfig)=='object'){
						    wx.onMenuShareQZone(wxshareZoneConfig);
						}
					});
					wx.error(function(res) {
						console.log(res);
						// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
					});
				})
			}
		}
	}
</script>

<style>
	page {
		height: 100%;
	}

	.display {
		display: none;
	}

	.content {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	.bg_box {
		height: 100vh;
		width: 100%;
		background: #fafafa;
		overflow: hidden;
	}

	#myVideo {
		width: 100%;
		height: 100vh;
	}

	.fle {
		position: fixed;
		top: 82%;
		left: 5%;
		width: 160rpx;
		height: 160rpx;
		z-index: 10000;
		transform: rotate(0deg);
		transition: transform 0.2s;
	}

	.addAnimation {
		transform: rotate(-45deg);
		animation: myf2 1.5s ease-in-out;
		animation-fill-mode: forwards
	}
	uni-image{
		width: 100%;
		height: 100%;
	}
	.uni-video-bar {
		bottom: -100rpx
	}
	/deep/ .uni-video-video{
		object-fit: cover;
	}
	.myVideo{
		position: absolute;
		z-index: 100;
		width: 100%;
		height: 100%;
		background: url(../../static/fengmian.png) no-repeat center center;
		background-size: 101% 100%;
	}
	.myVideo.nobg{
		z-index: 0;
	}
	.myVideo.endbg{
		z-index: 100;
		background: url(../../static/endbg.png) no-repeat center center;
		background-size: 101% 100%;
	}
	@keyframes myf2 {
		0% {
			top: 82%;
			left: 5%;
		}

		100% {
			top: 50%;
			left: 100%;
		}
	}
</style>
