import{T as d,o as r,e as m,b as e,u as a,Z as c,w as o,t as _,h as f,a as t,n as p,f as w,i as g,F as b}from"./app-737cfb06.js";import{_ as y,A as h}from"./AuthenticationCardLogo-84442d3e.js";import{_ as x,a as k}from"./TextInput-a0cffc1a.js";import{_ as V}from"./InputLabel-75eba958.js";import{_ as v}from"./PrimaryButton-f740c22b.js";const F=t("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$=["onSubmit"],C={class:"flex items-center justify-end mt-4"},j={__name:"ForgotPassword",props:{status:String},setup(l){const s=d({email:""}),n=()=>{s.post(route("password.email"))};return(S,i)=>(r(),m(b,null,[e(a(c),{title:"Forgot Password"}),e(h,null,{logo:o(()=>[e(y)]),default:o(()=>[F,l.status?(r(),m("div",N,_(l.status),1)):f("",!0),t("form",{onSubmit:g(n,["prevent"])},[t("div",null,[e(V,{for:"email",value:"Email"}),e(x,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":i[0]||(i[0]=u=>a(s).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(k,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",C,[e(v,{class:p({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:o(()=>[w(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{j as default};