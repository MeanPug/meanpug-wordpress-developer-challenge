<?php
/**
 * Block: Account Menu (airPnP)
 *
 * Airbnb-style account pill (hamburger + avatar) that toggles a dropdown menu.
 * Everything is hardcoded placeholder content EXCEPT the avatar image, which is
 * an editable block field.
 *
 * @var array $attributes
 */

// The only editable field: avatar image (stored as attachment ID).
$avatar_value = isset( $attributes['avatar'] ) ? $attributes['avatar'] : '';
$avatar_url   = ! empty( $avatar_value ) ? gw_get_image_url( $avatar_value, 'thumbnail' ) : '';

// Print the shared CSS/JS only once per page, even if the block repeats.
$print_assets = empty( $GLOBALS['airpnp_account_menu_assets'] );
$GLOBALS['airpnp_account_menu_assets'] = true;
?>

<?php if ( $print_assets ) : ?>
<style>
.airpnp-account{position:relative;display:inline-block;font-family:inherit;text-align:left}
.airpnp-account__trigger{display:flex;align-items:center;gap:10px;padding:5px 6px 5px 12px;background:#fff;border:1px solid #ddd;border-radius:999px;cursor:pointer;transition:box-shadow .2s ease}
.airpnp-account__trigger:hover{box-shadow:0 2px 8px rgba(0,0,0,.12)}
.airpnp-account__bars{display:block;color:#222}
.airpnp-account__avatar{width:30px;height:30px;border-radius:50%;background:#717171;object-fit:cover;display:flex;align-items:center;justify-content:center;overflow:hidden}
.airpnp-account__avatar svg{width:18px;height:18px;color:#fff}
.airpnp-account__menu{position:absolute;top:calc(100% + 12px);right:0;width:240px;background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:12px;box-shadow:0 2px 16px rgba(0,0,0,.12);padding:8px 0;opacity:0;visibility:hidden;transform:translateY(-6px);transition:opacity .15s ease,transform .15s ease;z-index:50}
.airpnp-account.is-open .airpnp-account__menu{opacity:1;visibility:visible;transform:translateY(0)}
.airpnp-account__item{display:flex;align-items:center;gap:12px;padding:12px 16px;font-size:14px;line-height:1.3;color:#222;text-decoration:none;white-space:nowrap}
.airpnp-account__item:hover{background:#f7f7f7}
.airpnp-account__item--feature{align-items:flex-start;gap:8px;justify-content:space-between}
.airpnp-account__feature-text strong{display:block;font-weight:600}
.airpnp-account__feature-text span{display:block;color:#717171;font-size:13px;margin-top:2px;white-space:normal;max-width:150px}
.airpnp-account__illus{flex:0 0 auto}
.airpnp-account__sep{height:1px;background:#ebebeb;margin:8px 0}
.airpnp-account__ico{flex:0 0 auto;color:#222}
</style>
<script>
document.addEventListener('click',function(e){
  document.querySelectorAll('.airpnp-account').forEach(function(el){
    var trigger=el.querySelector('.airpnp-account__trigger');
    if(trigger&&trigger.contains(e.target)){
      var open=el.classList.toggle('is-open');
      trigger.setAttribute('aria-expanded',open?'true':'false');
    }else if(!el.contains(e.target)){
      el.classList.remove('is-open');
      if(trigger)trigger.setAttribute('aria-expanded','false');
    }
  });
});
document.addEventListener('keydown',function(e){
  if(e.key==='Escape'){
    document.querySelectorAll('.airpnp-account.is-open').forEach(function(el){
      el.classList.remove('is-open');
      var t=el.querySelector('.airpnp-account__trigger');
      if(t)t.setAttribute('aria-expanded','false');
    });
  }
});
</script>
<?php endif; ?>

<div class="airpnp-account">
	<button type="button" class="airpnp-account__trigger" aria-haspopup="menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Account menu', 'gwblueprint' ); ?>">
		<span class="airpnp-account__bars" aria-hidden="true">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"><path d="M2 4h12M2 8h12M2 12h12"/></svg>
		</span>
		<span class="airpnp-account__avatar">
			<?php if ( $avatar_url ) : ?>
				<img src="<?php echo esc_url( $avatar_url ); ?>" alt="" style="width:100%;height:100%;object-fit:cover" />
			<?php else : ?>
				<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5 0-9 2.7-9 6v2h18v-2c0-3.3-4-6-9-6z"/></svg>
			<?php endif; ?>
		</span>
	</button>

	<div class="airpnp-account__menu" role="menu">
		<a href="#" class="airpnp-account__item" role="menuitem">
			<span class="airpnp-account__ico" aria-hidden="true">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="6.5"/><path d="M6.2 6.2a1.8 1.8 0 113 1.4c-.7.5-1.2.9-1.2 1.6" stroke-linecap="round"/><circle cx="8" cy="11.3" r=".6" fill="currentColor" stroke="none"/></svg>
			</span>
			<?php esc_html_e( 'Help Center', 'gwblueprint' ); ?>
		</a>

		<div class="airpnp-account__sep"></div>

		<a href="#" class="airpnp-account__item airpnp-account__item--feature" role="menuitem">
			<span class="airpnp-account__feature-text">
				<strong><?php esc_html_e( 'Become a host', 'gwblueprint' ); ?></strong>
				<span><?php esc_html_e( "It's easy to start hosting and earn extra income.", 'gwblueprint' ); ?></span>
			</span>
			<span class="airpnp-account__illus" aria-hidden="true">
				<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#FFF0F3"/><path d="M12 22l8-7 8 7v8h-5v-5h-6v5h-5v-8z" fill="#FF385C"/></svg>
			</span>
		</a>

		<div class="airpnp-account__sep"></div>

		<a href="#" class="airpnp-account__item" role="menuitem"><?php esc_html_e( 'Refer a host', 'gwblueprint' ); ?></a>
		<a href="#" class="airpnp-account__item" role="menuitem"><?php esc_html_e( 'Find a co-host', 'gwblueprint' ); ?></a>
		<a href="#" class="airpnp-account__item" role="menuitem"><?php esc_html_e( 'Gift cards', 'gwblueprint' ); ?></a>

		<div class="airpnp-account__sep"></div>

		<a href="#" class="airpnp-account__item" role="menuitem"><?php esc_html_e( 'Log in or sign up', 'gwblueprint' ); ?></a>
	</div>
</div>
