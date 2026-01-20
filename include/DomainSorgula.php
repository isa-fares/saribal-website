<?php
class AlanAdiSorgula{
	
	protected $yasakKarakter = array(
			"/","\"","'","&","\\","%","$","#","@","€","[","]","{","}","*","?","=","^","<",">","!","~",",",";","|","´","`"
		);
	public $hata = array(
		2 => 'Belirttiğiniz alan adında kullanılmayan karakterler var',
		3 => 'Baglanti kurulamiyor',
		4 => 'Herhangi bir sunucu seçmediniz veya istenilen sunucu sorgu listemizde mevcut değil',
		5 => 'Alan adınızı boş bıraktınız veya farklı bir problem var',
	);

	
	protected $servers = array(
		"biz" => "whois.neulevel.biz",
		"com" => "whois.internic.net",
		"us" => "whois.nic.us",
		"coop" => "whois.nic.coop",
		"info" => "whois.nic.info",
		"name" => "whois.nic.name",
		"net" => "whois.internic.net",
		"gov" => "whois.nic.gov",
		"edu" => "whois.internic.net",
		"mil" => "rs.internic.net",
		"int" => "whois.iana.org",
		"ac" => "whois.nic.ac",
		"ae" => "whois.uaenic.ae",
		"at" => "whois.ripe.net",
		"au" => "whois.aunic.net",
		"be" => "whois.dns.be",
		"bg" => "whois.ripe.net",
		"br" => "whois.registro.br",
		"bz" => "whois.belizenic.bz",
		"ca" => "whois.cira.ca",
		"cc" => "whois.nic.cc",
		"ch" => "whois.nic.ch",
		"cl" => "whois.nic.cl",
		"cn" => "whois.cnnic.net.cn",
		"cz" => "whois.nic.cz",
		"de" => "whois.nic.de",
		"fr" => "whois.nic.fr",
		"hu" => "whois.nic.hu",
		"ie" => "whois.domainregistry.ie",
		"il" => "whois.isoc.org.il",
		"in" => "whois.ncst.ernet.in",
		"ir" => "whois.nic.ir",
		"mc" => "whois.ripe.net",
		"to" => "whois.tonic.to",
		"tv" => "whois.nic.tv",
		"ru" => "whois.ripn.net",
		"org" => "whois.pir.org",
		"aero" => "whois.information.aero",
		"nl"    =>  "whois.domain-registry.nl",
		"com.tr" => "whois.nic.tr",
		"gen.tr" => "whois.nic.tr",
		"web.tr" => "whois.nic.tr",
		"k12.tr" => "whois.nic.tr",
		"org.tr" => "whois.nic.tr"
	);
	
	protected $domain = 'vemedya.com';
	public  $domainBilgi = array();
	public $alanAdi;
	public $uzanti;
	public $hataSonuc = "0";


    protected function domainSorgula($domain,$uzanti){
		
		$karakter = strlen($domain);
		for($i = 0; $i < $karakter; $i++){
			if(@in_array($domain[$i], $this->yasakKarakter)){
				$this->domainBilgi[$uzanti]['hata'] = 2;
				return false;
				$this->hataSonuc = "1";
			}
		}

		if(empty($this->servers[$uzanti])){
			$this->domainBilgi[$uzanti]['hata'] = 4;
            $this->hataSonuc = "1";
            return false;
		}
		
		$baglan = $this->servers[$uzanti];
		
		$output = '';
		try{
			if ($conn = fsockopen ($baglan, 43)) {
				fputs($conn, $domain.'.'.$uzanti."\r\n");
				while(!feof($conn)) {
					$output .= fgets($conn,128);
				}
				fclose($conn);
			}
			else {
				$this->domainBilgi[$uzanti]['hata'] = 3;
				$this->hataSonuc = "1";
			}
			
		}catch(exception $e){
			$this->domainBilgi[$uzanti]['hata'] = 3;
			$this->hataSonuc = "1";
		}
		
		$this->domainBilgi[$uzanti]['whois'] = $output;
		if(stristr($output,"No match") || stristr($output,"No entries" ) || stristr($output, "NOT FOUND" ) ){
			$this->domainBilgi[$uzanti]['hata'] = 0;
		}
		else {
			$this->domainBilgi[$uzanti]['hata'] = 1;
		}

	}


	public function domainkontrol(){
		
		$domain = strip_tags($this->alanAdi);
		$this->domain = $this->domainPakle($domain);
		$uzanti = strip_tags($this->uzanti);
		$uzanti = strtolower(trim($uzanti));
		$sonuc = $this->domainSorgula($this->domain, $uzanti);	
	
		return $this->domainBilgi[$uzanti]['hata'];

	}

	protected function domainPakle($domain){
		$domain = strtolower(trim($domain));
		$domain = str_replace(array('www.','http://'), array('',''), $domain);
		$slac = explode('/', $domain);
		$nokta = explode('.',$slac[0]);
		return $nokta[0];
	}
	

	
}


